<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function home()
    {
        $profile = Profile::first();
        $projects = Project::latest()->take(3)->get();
        $skills = Skill::latest()->take(6)->get();
        $experiences = Experience::latest()->take(3)->get();

        return view('home', compact(
            'profile',
            'projects',
            'skills',
            'experiences'
        ));
    }

    public function about()
    {
        $profile = Profile::first();

        return view('about', compact('profile'));
    }

    public function skills()
    {
        $skills = Skill::latest()->get();

        return view('skills', compact('skills'));
    }

    public function projects(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $technology = trim((string) $request->query('technology', ''));
        $sort = $request->query('sort', 'latest');

        if (!in_array($sort, ['latest', 'oldest', 'name'], true)) {
            $sort = 'latest';
        }

        $query = Project::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('technologies', 'like', '%' . $search . '%');
            });
        }

        if ($technology !== '') {
            $query->where('technologies', 'like', '%' . $technology . '%');
        }

        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name') {
            $query->orderBy('title');
        } else {
            $query->latest();
        }

        $projects = $query->paginate(9)->withQueryString();

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

    public function projectDetail(Project $project)
    {
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact(
            'project',
            'relatedProjects'
        ));
    }

    public function experience()
    {
        $experiences = Experience::latest()->get();

        return view('experience', compact('experiences'));
    }

    public function contact()
    {
        $profile = Profile::first();

        return view('contact', compact('profile'));
    }
}
