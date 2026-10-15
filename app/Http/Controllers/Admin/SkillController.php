<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    // Danh sách kỹ năng
    public function index(Request $request)
    {
        $type = $request->query('type');

        $skills = Skill::query()
            ->when(
                in_array($type, ['programming', 'personal'], true),
                fn ($query) => $query->where('type', $type)
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.skills.index', compact('skills', 'type'));
    }

    // Form thêm kỹ năng
    public function create()
    {
        return view('admin.skills.create');
    }

    // Lưu kỹ năng mới
    public function store(Request $request)
    {
        $data = $this->validateSkill($request);
        $newIcon = null;

        if ($request->hasFile('icon')) {
            $newIcon = $request->file('icon')
                ->store('skills', 'public');

            $data['icon'] = $newIcon;
        }

        try {
            Skill::create($data);
        } catch (\Throwable $e) {
            // Xóa ảnh mới nếu lưu database thất bại
            if ($newIcon) {
                Storage::disk('public')->delete($newIcon);
            }

            throw $e;
        }

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Thêm kỹ năng thành công!');
    }

    // Form sửa kỹ năng
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    // Cập nhật kỹ năng
    public function update(Request $request, Skill $skill)
    {
        $data = $this->validateSkill($request);

        $oldIcon = $skill->icon;
        $newIcon = null;

        if ($request->hasFile('icon')) {
            $newIcon = $request->file('icon')
                ->store('skills', 'public');

            $data['icon'] = $newIcon;
        }

        try {
            $skill->update($data);
        } catch (\Throwable $e) {
            // Xóa ảnh mới nếu cập nhật database thất bại
            if ($newIcon) {
                Storage::disk('public')->delete($newIcon);
            }

            throw $e;
        }

        // Xóa ảnh cũ sau khi cập nhật thành công
        if (
            $newIcon &&
            $oldIcon &&
            str_starts_with($oldIcon, 'skills/') &&
            $oldIcon !== $newIcon
        ) {
            Storage::disk('public')->delete($oldIcon);
        }

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Cập nhật kỹ năng thành công!');
    }

    // Xóa kỹ năng
    public function destroy(Skill $skill)
    {
        $icon = $skill->icon;

        $skill->delete();

        // Chỉ xóa ảnh thuộc thư mục skills
        if (
            $icon &&
            str_starts_with($icon, 'skills/')
        ) {
            Storage::disk('public')->delete($icon);
        }

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Xóa kỹ năng thành công!');
    }

    // Kiểm tra dữ liệu thêm và sửa
    private function validateSkill(Request $request): array
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                Rule::in(['programming', 'personal']),
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'level' => [
                'exclude_if:type,personal',
                'required_if:type,programming',
                'nullable',
                'integer',
                'between:0,100',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:99999',
            ],

            'icon' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Kỹ năng cá nhân không sử dụng phần trăm
        if ($data['type'] === 'personal') {
            $data['level'] = null;
        }

        // Mặc định thứ tự hiển thị
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // File ảnh được xử lý riêng
        unset($data['icon']);

        return $data;
    }
}
