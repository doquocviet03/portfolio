<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    // Danh sách kinh nghiệm
    public function index()
    {
        $experiences = Experience::latest()->paginate(10);

        return view(
            'admin.experiences.index',
            compact('experiences')
        );
    }

    // Form thêm kinh nghiệm
    public function create()
    {
        return view('admin.experiences.create');
    }

    // Lưu kinh nghiệm mới
    public function store(Request $request)
    {
        $data = $this->validateExperience($request);

        Experience::create($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with(
                'success',
                'Thêm kinh nghiệm thành công!'
            );
    }

    // Form chỉnh sửa kinh nghiệm
    public function edit(Experience $experience)
    {
        return view(
            'admin.experiences.edit',
            compact('experience')
        );
    }

    // Cập nhật kinh nghiệm
    public function update(
        Request $request,
        Experience $experience
    ) {
        $data = $this->validateExperience($request);

        $experience->update($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with(
                'success',
                'Cập nhật kinh nghiệm thành công!'
            );
    }

    // Xóa kinh nghiệm
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with(
                'success',
                'Xóa kinh nghiệm thành công!'
            );
    }

    /**
     * Tự động dịch kinh nghiệm VI -> EN.
     * Không lưu database tại bước này.
     */
    public function translate(
        Request $request,
        TranslationService $translator
    ) {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:10000',
        ]);

        $fields = [
            'title',
            'company',
            'description',
        ];

        $translations = [];
        $errors = [];

        if (
            collect($fields)->every(
                fn ($field) =>
                    trim((string) ($data[$field] ?? '')) === ''
            )
        ) {
            return response()->json([
                'message' =>
                    'Vui lòng nhập nội dung cần dịch.',
            ], 422);
        }

        foreach ($fields as $field) {
            $value = trim((string) ($data[$field] ?? ''));

            if ($value === '') {
                continue;
            }

            try {
                $translations[$field . '_en'] =
                    $translator->translate($value);
            } catch (\Throwable $e) {
                report($e);

                $errors[$field] =
                    'Không thể dịch trường này.';
            }
        }

        return response()->json([
            'translations' => $translations,
            'errors' => $errors,
            'message' => empty($errors)
                ? 'Dịch tự động thành công!'
                : 'Một số trường chưa dịch được.',
        ]);
    }

    /**
     * Kiểm tra dữ liệu khi thêm/cập nhật.
     */
    private function validateExperience(
        Request $request
    ): array {
        return $request->validate([
            // Tiếng Việt
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'company' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            // Tiếng Anh
            'title_en' => [
                'nullable',
                'string',
                'max:255',
            ],

            'company_en' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description_en' => [
                'nullable',
                'string',
            ],

            // Thời gian
            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
        ]);
    }
}
