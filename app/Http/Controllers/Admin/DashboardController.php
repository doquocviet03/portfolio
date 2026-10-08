<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $projectCount = Project::count();
        $skillCount = Skill::count();
        $experienceCount = Experience::count();
        $contactCount = Contact::count();

        $recentProjects = Project::latest()
            ->take(5)
            ->get();

        $recentContacts = Contact::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'projectCount',
            'skillCount',
            'experienceCount',
            'contactCount',
            'recentProjects',
            'recentContacts'
        ));
    }
}
