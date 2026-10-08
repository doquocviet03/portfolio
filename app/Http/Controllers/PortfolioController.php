<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;

class PortfolioController extends Controller
{
    // Trang chủ
    public function home()
    {
        $projects = Project::latest()->take(3)->get();
        $skills = Skill::latest()->take(6)->get();
        $experiences = Experience::latest()->take(3)->get();

        return view('home', compact(
            'projects',
            'skills',
            'experiences'
        ));
    }

    // Trang giới thiệu
    public function about()
    {
        return view('about');
    }

    // Trang kỹ năng
    public function skills()
    {
        $skills = Skill::latest()->get();

        return view('skills', compact('skills'));
    }

    // Trang dự án
    public function projects()
    {
        $projects = Project::latest()->get();

        return view('projects', compact('projects'));
    }

    // Trang kinh nghiệm
    public function experience()
    {
        $experiences = Experience::latest()->get();

        return view('experience', compact('experiences'));
    }

    // Trang liên hệ
    public function contact()
    {
        return view('contact');
    }
}
