<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Get dashboard statistics
        $totalLeads = Lead::count();
        $recentLeads = Lead::with('user')->latest()->take(5)->get();
        $leadsByStatus = Lead::selectRaw('status, COUNT(*) as count')
            ->whereNotNull('status')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Calculate additional metrics
        $newLeads = $leadsByStatus['New'] ?? 0;
        $contactedLeads = $leadsByStatus['Contacted'] ?? 0;
        $workingLeads = $leadsByStatus['Working'] ?? 0;
        $qualifiedLeads = $leadsByStatus['Qualified'] ?? 0;
        $customerLeads = $leadsByStatus['Customer'] ?? 0;
        $declinedLeads = $leadsByStatus['Declined'] ?? 0;

        $activeLeads = $newLeads + $contactedLeads + $workingLeads;
        $convertedLeads = $customerLeads;

        // Get leads by source
        $leadsBySource = Lead::selectRaw('source, COUNT(*) as count')
            ->whereNotNull('source')
            ->groupBy('source')
            ->pluck('count', 'source')
            ->toArray();

        return view('admin.dashboard-simple', compact(
            'totalLeads', 
            'recentLeads', 
            'leadsByStatus', 
            'activeLeads', 
            'convertedLeads', 
            'leadsBySource',
            'newLeads',
            'qualifiedLeads'
        ));
    }
}