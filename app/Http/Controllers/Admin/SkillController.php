<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->paginate(10);

        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|between:0,100',
        ]);

        Skill::create($data);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Thêm kỹ năng thành công!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|between:0,100',
        ]);

        $skill->update($data);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Cập nhật kỹ năng thành công!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Xóa kỹ năng thành công!');
    }
}
