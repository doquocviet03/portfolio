<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $skills = Skill::query()
            ->when(in_array($type, ['programming', 'personal'], true),
                fn ($query) => $query->where('type', $type))
            ->orderBy('sort_order')->orderBy('id')->paginate(10)->withQueryString();

        return view('admin.skills.index', compact('skills', 'type'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateSkill($request);
        // Keep a numeric value for existing schemas that require level.
        $data['level'] = $data['type'] === 'programming' ? 0 : null;
        $newIcon = null;

        if ($request->hasFile('icon')) {
            $newIcon = $request->file('icon')->store('skills', 'public');
            $data['icon'] = $newIcon;
        }

        try {
            Skill::create($data);
        } catch (\Throwable $e) {
            if ($newIcon) {
                Storage::disk('public')->delete($newIcon);
            }
            throw $e;
        }

        return redirect()->route('admin.skills.index')
            ->with('success', 'Thêm kỹ năng thành công!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $this->validateSkill($request);
        // Preserve existing levels in the database; do not display or edit them.
        $data['level'] = $data['type'] === 'programming'
            ? ($skill->level ?? 0)
            : null;

        $oldIcon = $skill->icon;
        $newIcon = null;
        if ($request->hasFile('icon')) {
            $newIcon = $request->file('icon')->store('skills', 'public');
            $data['icon'] = $newIcon;
        }

        try {
            $skill->update($data);
        } catch (\Throwable $e) {
            if ($newIcon) {
                Storage::disk('public')->delete($newIcon);
            }
            throw $e;
        }

        if ($newIcon && $oldIcon && str_starts_with($oldIcon, 'skills/') && $oldIcon !== $newIcon) {
            Storage::disk('public')->delete($oldIcon);
        }

        return redirect()->route('admin.skills.index')
            ->with('success', 'Cập nhật kỹ năng thành công!');
    }

    public function destroy(Skill $skill)
    {
        $icon = $skill->icon;
        $skill->delete();
        if ($icon && str_starts_with($icon, 'skills/')) {
            Storage::disk('public')->delete($icon);
        }
        return redirect()->route('admin.skills.index')
            ->with('success', 'Xóa kỹ năng thành công!');
    }

    public function translate(Request $request, TranslationService $translator)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $fields = ['name', 'description'];
        $translations = [];
        $errors = [];

        if (trim((string) ($data['name'] ?? '')) === '' &&
            trim((string) ($data['description'] ?? '')) === '') {
            return response()->json(['message' => 'Vui lòng nhập tên hoặc mô tả kỹ năng.'], 422);
        }

        foreach ($fields as $field) {
            $value = trim((string) ($data[$field] ?? ''));
            if ($value === '') {
                $translations[$field . '_en'] = '';
                continue;
            }
            try {
                $translations[$field . '_en'] = $translator->translate($value);
            } catch (\Throwable $e) {
                report($e);
                $errors[$field] = 'Không thể dịch trường này.';
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

    private function validateSkill(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'type' => ['required', Rule::in(['programming', 'personal'])],
            'description' => ['nullable', 'string', 'max:2000'],
            'description_en' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        unset($data['icon']);
        return $data;
    }
}
