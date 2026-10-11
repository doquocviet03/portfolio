<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DANH SÁCH VÀ TÌM KIẾM DỰ ÁN
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = trim((string) $request->query('search', ''));

        // Lấy kiểu sắp xếp
        $sort = $request->query('sort', 'latest');

        if (!in_array($sort, ['latest', 'oldest', 'name'], true)) {
            $sort = 'latest';
        }

        // Khởi tạo truy vấn
        $query = Project::query();

        // Tìm kiếm theo tên, mô tả hoặc công nghệ
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('technologies', 'like', '%' . $search . '%');
            });
        }

        // Sắp xếp
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->latest();
        }

        // Phân trang và giữ bộ lọc
        $projects = $query
            ->paginate(10)
            ->withQueryString();

        // Tổng số dự án trong database
        $totalProjects = Project::count();

        return view('admin.projects.index', compact(
            'projects',
            'search',
            'sort',
            'totalProjects'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM THÊM DỰ ÁN
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.projects.create');
    }

    /*
    |--------------------------------------------------------------------------
    | LƯU DỰ ÁN MỚI
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'required',
                'string'
            ],

            'technologies' => [
                'nullable',
                'string',
                'max:2000'
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'demo_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'features' => [
                'nullable',
                'string'
            ],

            'challenges' => [
                'nullable',
                'string'
            ],

            'results' => [
                'nullable',
                'string'
            ],
        ]);

        $newImage = null;

        // Upload ảnh
        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('projects', 'public');

            $validated['image'] = $newImage;
        }

        try {
            Project::create($validated);
        } catch (\Throwable $e) {

            // Xóa ảnh mới nếu lưu database thất bại
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }

            throw $e;
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Thêm dự án thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CHỈNH SỬA DỰ ÁN
    |--------------------------------------------------------------------------
    */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /*
    |--------------------------------------------------------------------------
    | CẬP NHẬT DỰ ÁN
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'required',
                'string'
            ],

            'technologies' => [
                'nullable',
                'string',
                'max:2000'
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'demo_url' => [
                'nullable',
                'url',
                'max:2048'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'features' => [
                'nullable',
                'string'
            ],

            'challenges' => [
                'nullable',
                'string'
            ],

            'results' => [
                'nullable',
                'string'
            ],
        ]);

        // Lưu đường dẫn ảnh cũ
        $oldImage = $project->image;
        $newImage = null;

        // Nếu người dùng chọn ảnh mới
        if ($request->hasFile('image')) {

            $newImage = $request->file('image')
                ->store('projects', 'public');

            $validated['image'] = $newImage;
        }

        try {
            // Cập nhật dữ liệu
            $project->update($validated);
        } catch (\Throwable $e) {

            // Nếu database lỗi thì xóa ảnh mới
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }

            throw $e;
        }

        // Xóa ảnh cũ sau khi cập nhật thành công
        if (
            $newImage &&
            $oldImage &&
            $oldImage !== $newImage
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Cập nhật dự án thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | XÓA DỰ ÁN
    |--------------------------------------------------------------------------
    */
    public function destroy(Project $project)
    {
        // Lưu đường dẫn ảnh trước khi xóa
        $image = $project->image;

        // Xóa dữ liệu trong database
        $project->delete();

        // Xóa ảnh liên quan
        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Xóa dự án thành công!');
    }
}
