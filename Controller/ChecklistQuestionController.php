<?php

namespace App\Http\Controllers;

use App\Models\Checklists;
use App\Models\ChecklistQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Checklists $checklist = null)
    {
        if ($checklist) {
            $questions = $checklist->questions()->orderBy('id')->get();
            return view('checklist-questions.index', compact('questions', 'checklist'));
        }
        
        $questions = ChecklistQuestion::orderBy('checklist_name')->orderBy('id')->get();
        return view('checklist-questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Checklists $checklist = null)
    {
        $checklists = Checklists::all();
        return view('checklist-questions.create', compact('checklists', 'checklist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Checklists $checklist)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'comment' => 'required|in:Text Answer,Number Answer,Yes/No Answer'
        ]);

        $validated['checklist_id'] = $checklist->id;
        $validated['checklist_name'] = $checklist->name;
        $validated['created_by'] = Auth::id();

        $question = ChecklistQuestion::create($validated);

        return redirect()->route('checklists.questions.index', $checklist)
            ->with('success', trans('admin/checklists/general.question_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ChecklistQuestion $checklistQuestion)
    {
        return view('checklist-questions.show', compact('checklistQuestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChecklistQuestion $checklistQuestion)
    {
        return view('checklist-questions.edit', compact('checklistQuestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChecklistQuestion $checklistQuestion)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'comment' => 'required|in:Text Answer,Number Answer,Yes/No Answer'
        ]);

        $checklistQuestion->update($validated);

        return redirect()->route('checklists.questions.index', $checklistQuestion->checklist_id)
            ->with('success', trans('admin/checklists/general.question_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChecklistQuestion $checklistQuestion)
    {
        try {
            $checklist_id = $checklistQuestion->checklist_id;
            $checklistQuestion->forceDelete();

            return redirect()->route('checklists.questions.index', $checklist_id)
                ->with('success', trans('admin/checklists/general.question_deleted'));
        } catch (\Exception $e) {
            return redirect()->route('checklists.questions.index', $checklist_id)
                ->with('error', 'Error deleting question: ' . $e->getMessage());
        }
    }
}
