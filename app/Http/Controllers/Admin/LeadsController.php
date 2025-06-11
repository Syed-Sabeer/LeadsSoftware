<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with('user');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by source
        if ($request->has('source') && !empty($request->source)) {
            $query->where('source', $request->source);
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get unique statuses and sources for filter dropdowns
        $statuses = Lead::distinct()->pluck('status')->filter()->values();
        $sources = Lead::distinct()->pluck('source')->filter()->values();

        return view('admin.leads-list', compact('leads', 'statuses', 'sources'));
    }

    public function create()
    {
        return view('admin.leads-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'status' => 'nullable|string|max:100',
            'source' => 'nullable|string|max:100',
            'disposition' => 'nullable|string',
            'additional_details' => 'nullable|string',
            'comments' => 'nullable|string',
            'country' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $lead = Lead::create([
                'user_id' => auth()->id(),
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'company' => $request->company,
                'website' => $request->website,
                'status' => $request->status,
                'source' => $request->source,
                'disposition' => $request->disposition,
                'additional_details' => $request->additional_details,
                'comments' => $request->comments,
                'country' => $request->country,
            ]);

            return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create lead. Please try again.')->withInput();
        }
    }

    public function show(Lead $lead)
    {
        $lead->load('user');
        return view('admin.leads-view', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('admin.leads-create', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'status' => 'nullable|string|max:100',
            'source' => 'nullable|string|max:100',
            'disposition' => 'nullable|string',
            'additional_details' => 'nullable|string',
            'comments' => 'nullable|string',
            'country' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $lead->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'company' => $request->company,
                'website' => $request->website,
                'status' => $request->status,
                'source' => $request->source,
                'disposition' => $request->disposition,
                'additional_details' => $request->additional_details,
                'comments' => $request->comments,
                'country' => $request->country,
            ]);

            return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update lead. Please try again.')->withInput();
        }
    }

    public function destroy(Lead $lead)
    {
        try {
            $lead->delete();
            return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete lead. Please try again.');
        }
    }
}