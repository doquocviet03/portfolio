<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê tổng số bản ghi
        $totalProjects = Project::count();
        $totalSkills = Skill::count();
        $totalExperiences = Experience::count();
        $totalContacts = Contact::count();

        // 5 dự án mới nhất
        $recentProjects = Project::latest()
            ->take(5)
            ->get();

        // 5 tin nhắn liên hệ mới nhất
        $recentContacts = Contact::latest()
            ->take(5)
            ->get();

        // Thống kê dự án trong 6 tháng gần nhất
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->startOfMonth()->subMonths($i);

            $start = $month->copy()->startOfMonth();
            $end = $month->copy()->endOfMonth();

            $chartLabels[] = 'Tháng ' . $month->format('m/Y');

            $chartData[] = Project::whereBetween(
                'created_at',
                [$start, $end]
            )->count();
        }

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalSkills',
            'totalExperiences',
            'totalContacts',
            'recentProjects',
            'recentContacts',
            'chartLabels',
            'chartData'
        ));
    }
}
