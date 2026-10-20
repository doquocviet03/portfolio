<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $sort = $request->query('sort', 'latest');
        if (!in_array($sort, ['latest', 'oldest', 'name'], true)) {
            $sort = 'latest';
        }

        $query = Project::query();
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('technologies', 'like', '%' . $search . '%')
                  ->orWhere('title_en', 'like', '%' . $search . '%')
                  ->orWhere('description_en', 'like', '%' . $search . '%');
            });
        }

        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->latest();
        }

        $projects = $query->paginate(10)->withQueryString();
        $totalProjects = Project::count();

        return view('admin.projects.index', compact('projects', 'search', 'sort', 'totalProjects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    private function validatedProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'technologies' => ['nullable', 'string', 'max:2000'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'demo_url' => ['nullable', 'url', 'max:2048'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'features' => ['nullable', 'string'],
            'challenges' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'features_en' => ['nullable', 'string'],
            'challenges_en' => ['nullable', 'string'],
            'results_en' => ['nullable', 'string'],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatedProject($request);
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('projects', 'public');
            $validated['image'] = $newImage;
        }

        try {
            Project::create($validated);
        } catch (\Throwable $e) {
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }
            throw $e;
        }

        return redirect()->route('admin.projects.index')->with('success', 'Thêm dự án thành công!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validatedProject($request);
        $oldImage = $project->image;
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('projects', 'public');
            $validated['image'] = $newImage;
        }

        try {
            $project->update($validated);
        } catch (\Throwable $e) {
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }
            throw $e;
        }

        if ($newImage && $oldImage && $oldImage !== $newImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật dự án thành công!');
    }

    public function destroy(Project $project)
    {
        $image = $project->image;
        $project->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Xóa dự án thành công!');
    }

    /**
     * Route POST must be inside the existing auth + admin middleware group.
     * Returns JSON to populate the English fields; does not save automatically.
     */
    public function translate(Request $request, TranslationService $translator)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'features' => ['nullable', 'string', 'max:10000'],
            'challenges' => ['nullable', 'string', 'max:10000'],
            'results' => ['nullable', 'string', 'max:10000'],
        ]);

        if (!collect($data)->contains(fn ($value) => is_string($value) && trim($value) !== '')) {
            throw ValidationException::withMessages([
                'title' => 'Hãy nhập ít nhất một nội dung tiếng Việt để dịch.',
            ]);
        }

        $translated = [];
        try {
            foreach (['title', 'description', 'features', 'challenges', 'results'] as $field) {
                $value = trim((string) ($data[$field] ?? ''));
                $translated[$field . '_en'] = $value === '' ? '' : $translator->translate($value);
            }
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'message' => 'Dịch tự động chưa thành công. Kiểm tra cấu hình API hoặc thử lại sau.',
            ], 502);
        }

        return response()->json(['translations' => $translated]);
    }
}
