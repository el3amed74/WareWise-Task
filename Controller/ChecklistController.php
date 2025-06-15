<?php

namespace App\Http\Controllers;

use App\Models\Checklists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checklists = Checklists::orderBy('created_at', 'desc')->get();
        return view('checklists.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('checklists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:daily,weekly,monthly,quarterly,yearly'
        ]);

        $validated['created_by'] = Auth::id();

        $checklist = Checklists::create($validated);

        return redirect()->route('checklists.index')
            ->with('success', trans('admin/checklists/general.checklist_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Checklists $checklist)
    {
        $questions = $checklist->questions()->orderBy('id')->get();
        return view('checklists.show', compact('checklist', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checklists $checklist)
    {
        return view('checklists.edit', compact('checklist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checklists $checklist)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:daily,weekly,monthly,quarterly,yearly'
            ]);

            // If name is changing, update related questions
            if ($checklist->name !== $validated['name']) {
                $checklist->questions()->update(['checklist_name' => $validated['name']]);
            }

            $checklist->update($validated);

            DB::commit();

            return redirect()->route('checklists.index')
                ->with('success', trans('admin/checklists/general.checklist_updated'));

        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('checklists.index')
                ->with('error', 'Error updating checklist: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklists $checklist)
    {
        try {
            DB::beginTransaction();
            
            // Force delete associated questions first
            $checklist->questions()->forceDelete();
            
            // Then force delete the checklist
            $checklist->forceDelete();
            
            DB::commit();
            
            return redirect()->route('checklists.index')
                ->with('success', trans('admin/checklists/general.checklist_deleted'));
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('checklists.index')
                ->with('error', 'Error deleting checklist: ' . $e->getMessage());
        }
    }
}
