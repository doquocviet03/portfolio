<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // Trang chủ
    public function home()
    {
        $profile = Profile::first();

        $projects = Project::latest()
            ->take(3)
            ->get();

        $skills = Skill::latest()
            ->take(6)
            ->get();

        $experiences = Experience::latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'profile',
            'projects',
            'skills',
            'experiences'
        ));
    }

    // Trang giới thiệu
    public function about()
    {
        $profile = Profile::first();

        return view('about', compact('profile'));
    }

    // Trang kỹ năng
    public function skills()
    {
        // Kỹ năng lập trình
        $programmingSkills = Skill::query()
            ->where('type', 'programming')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // Kỹ năng cá nhân
        $personalSkills = Skill::query()
            ->where('type', 'personal')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // Giữ tương thích với giao diện cũ
        $skills = $programmingSkills;

        return view('skills', compact(
            'skills',
            'programmingSkills',
            'personalSkills'
        ));
    }

    // Danh sách dự án
    public function projects(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $technology = trim(
            (string) $request->query('technology', '')
        );

        $sort = $request->query('sort', 'latest');

        if (!in_array($sort, [
            'latest',
            'oldest',
            'name'
        ], true)) {
            $sort = 'latest';
        }

        $query = Project::query();

        // Tìm kiếm bằng tiếng Việt và tiếng Anh
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $keyword = '%' . $search . '%';

                $q->where('title', 'like', $keyword)
                    ->orWhere('description', 'like', $keyword)
                    ->orWhere('title_en', 'like', $keyword)
                    ->orWhere('description_en', 'like', $keyword)
                    ->orWhere('technologies', 'like', $keyword);
            });
        }

        // Lọc theo công nghệ
        if ($technology !== '') {
            $query->where(
                'technologies',
                'like',
                '%' . $technology . '%'
            );
        }

        // Sắp xếp dự án
        if ($sort === 'oldest') {
            $query->oldest();

        } elseif ($sort === 'name') {

            if (app()->getLocale() === 'en') {
                $query->orderByRaw(
                    "COALESCE(NULLIF(title_en, ''), title) ASC"
                );
            } else {
                $query->orderBy('title', 'asc');
            }

        } else {
            $query->latest();
        }

        // Phân trang
        $projects = $query
            ->paginate(9)
            ->withQueryString();

        // Danh sách công nghệ
        $technologies = Project::query()
            ->whereNotNull('technologies')
            ->pluck('technologies')
            ->flatMap(function ($value) {
                return explode(',', $value);
            })
            ->map(fn ($value) => trim($value))
            ->filter()
            ->unique(fn ($value) => mb_strtolower($value))
            ->sort()
            ->values();

        return view('projects', compact(
            'projects',
            'technologies',
            'search',
            'technology',
            'sort'
        ));
    }

    // Chi tiết dự án
    public function projectDetail(Project $project)
    {
        $relatedProjects = Project::query()
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact(
            'project',
            'relatedProjects'
        ));
    }

    // Kinh nghiệm làm việc
    public function experience()
    {
        $experiences = Experience::latest()->get();

        return view('experience', compact('experiences'));
    }

    // Liên hệ
    public function contact()
    {
        $profile = Profile::first();

        return view('contact', compact('profile'));
    }
}
