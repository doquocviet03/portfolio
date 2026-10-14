<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use App\Models\Contact;
use App\Models\ContactReply;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class ContactReplyController extends Controller
{
    public function create(Contact $contact)
    {
        $replies = ContactReply::where('contact_id', $contact->id)
            ->with('admin')
            ->latest()
            ->get();

        return view('admin.contacts.reply', compact('contact', 'replies'));
    }

    public function store(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:20000'],
            'submission_token' => ['required', 'uuid'],
        ]);

        $recipient = $contact->email;

        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            return back()->withInput()->with('error', 'Email người nhận không hợp lệ.');
        }

        // Insert trực tiếp để bảo đảm token được lưu ngay cả khi Model chưa khai báo fillable.
        // UNIQUE trong MySQL chặn cả những yêu cầu đồng thời có cùng token.
        try {
            $replyId = DB::table('contact_replies')->insertGetId([
                'contact_id' => $contact->id,
                'admin_id' => auth()->id(),
                'recipient_email' => $recipient,
                'subject' => $validated['subject'],
                'body' => $validated['body'],
                'submission_token' => $validated['submission_token'],
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (QueryException $e) {
            // MySQL: 1062 = duplicate key. Không gửi lại một yêu cầu đã được ghi nhận.
            if (($e->errorInfo[1] ?? null) === 1062) {
                return redirect()
                    ->route('admin.contacts.reply', $contact)
                    ->with('error', 'Yêu cầu gửi Email này đã được xử lý. Vui lòng xem lịch sử.');
            }

            throw $e;
        }

        $reply = ContactReply::findOrFail($replyId);

        return $this->sendReply($reply, $contact, false);
    }

    public function retry(Contact $contact, ContactReply $reply)
    {
        // Chặn gửi lại một Email thuộc tin nhắn khác.
        abort_unless((int) $reply->contact_id === (int) $contact->id, 404);

        // Chỉ một yêu cầu có thể chuyển failed -> pending.
        $claimed = DB::table('contact_replies')
            ->where('id', $reply->id)
            ->where('contact_id', $contact->id)
            ->where('status', 'failed')
            ->update([
                'status' => 'pending',
                'error_message' => null,
                'updated_at' => now(),
            ]);

        if ($claimed !== 1) {
            return redirect()
                ->route('admin.contacts.reply', $contact)
                ->with('error', 'Email này không còn ở trạng thái thất bại hoặc đang được gửi lại.');
        }

        $reply->refresh();

        return $this->sendReply($reply, $contact, true);
    }

    private function sendReply(ContactReply $reply, Contact $contact, bool $isRetry)
    {
        try {
            Mail::to($reply->recipient_email)->send(
                new ContactReplyMail($reply->subject, $reply->body)
            );

            $reply->update([
                'status' => 'sent',
                'sent_at' => now(),
                'error_message' => null,
            ]);

            return redirect()
                ->route('admin.contacts.reply', $contact)
                ->with('success', $isRetry
                    ? 'Đã gửi lại Email thành công.'
                    : 'Đã gửi Email trả lời thành công.');
        } catch (Throwable $e) {
            report($e);

            $reply->update([
                'status' => 'failed',
                'error_message' => Str::limit($e->getMessage(), 2000),
            ]);

            return redirect()
                ->route('admin.contacts.reply', $contact)
                ->with('error', 'Không thể gửi Email. Vui lòng kiểm tra SMTP và lịch sử gửi.');
        }
    }
}
