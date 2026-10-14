<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Contact;
use App\Models\ContactReply;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. THỐNG KÊ PORTFOLIO
        // ==========================================

        $totalProjects = Project::count();
        $totalSkills = Skill::count();
        $totalExperiences = Experience::count();
        $totalContacts = Contact::count();

        // ==========================================
        // 2. THỐNG KÊ EMAIL LIÊN HỆ
        // ==========================================

        // Các tin nhắn đã có ít nhất một email gửi thành công
        $sentContactIds = ContactReply::query()
            ->where('status', 'sent')
            ->select('contact_id');

        // Các tin nhắn đã có email gửi thất bại
        $failedContactIds = ContactReply::query()
            ->where('status', 'failed')
            ->select('contact_id');

        // Đã trả lời thành công
        $repliedContacts = Contact::query()
            ->whereIn('id', $sentContactIds)
            ->count();

        // Gửi thất bại và chưa có email thành công
        $failedContacts = Contact::query()
            ->whereIn('id', $failedContactIds)
            ->whereNotIn('id', $sentContactIds)
            ->count();

        // Chưa trả lời:
        // Bao gồm tin nhắn chưa gửi hoặc đang chờ gửi,
        // nhưng không bao gồm nhóm gửi thất bại.
        $unrepliedContacts = Contact::query()
            ->whereNotIn('id', $sentContactIds)
            ->whereNotIn('id', $failedContactIds)
            ->count();

        // ==========================================
        // 3. DỰ ÁN MỚI NHẤT
        // ==========================================

        $recentProjects = Project::latest()
            ->take(5)
            ->get();

        // ==========================================
        // 4. TIN NHẮN MỚI NHẤT
        // ==========================================

        $recentContacts = Contact::latest()
            ->take(5)
            ->get();

        // ==========================================
        // 5. BIỂU ĐỒ DỰ ÁN 6 THÁNG
        // ==========================================

        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()
                ->startOfMonth()
                ->subMonths($i);

            $start = $month->copy()->startOfMonth();
            $end = $month->copy()->endOfMonth();

            $chartLabels[] = 'Tháng ' . $month->format('m/Y');

            $chartData[] = Project::whereBetween(
                'created_at',
                [$start, $end]
            )->count();
        }

        // ==========================================
        // 6. TRẢ DỮ LIỆU VỀ VIEW
        // ==========================================

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalSkills',
            'totalExperiences',
            'totalContacts',
            'unrepliedContacts',
            'repliedContacts',
            'failedContacts',
            'recentProjects',
            'recentContacts',
            'chartLabels',
            'chartData'
        ));
    }
}
