@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('Questions') }} - {{ $checklist->name }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('checklists.questions.create', $checklist) }}" class="btn btn-primary pull-right">
        <i class="fas fa-plus"></i> {{ trans('Add Question') }}
    </a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="box-heading">
                    <h2 class="box-title text-primary">
                        <i class="fas fa-clipboard-check"></i> 
                        {{ $checklist->name }}
                    </h2>
                    <div class="box-subtitle">
                        <span class="badge badge-type">{{ ucfirst($checklist->type) }} Checklist</span>
                    </div>
                </div>
            </div>

            <div class="box-body">
                @if($questions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover modern-table">
                            <thead>
                                <tr>
                                    <th class="col-md-5">{{ trans('Question') }}</th>
                                    <th class="col-md-3">{{ trans('Answer Type') }}</th>
                                    <th class="col-md-2">{{ trans('Created') }}</th>
                                    <th class="col-md-2">{{ trans('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>
                                            <div class="question-text">
                                                {{ $question->question }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = 'badge-text';
                                                if ($question->comment == 'Yes/No Answer') {
                                                    $badgeClass = 'badge-boolean';
                                                } elseif ($question->comment == 'Number Answer') {
                                                    $badgeClass = 'badge-number';
                                                }
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ $question->comment }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $question->created_at->format('Y-m-d') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('checklist-questions.edit', $question) }}" 
                                                   class="btn btn-sm btn-default action-btn"
                                                   data-toggle="tooltip" 
                                                   title="Edit Question">
                                                    <i class="fas fa-edit text-warning"></i>
                                                </a>
                                                <form action="{{ route('checklist-questions.destroy', $question) }}" 
                                                      method="POST" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-default action-btn" 
                                                            data-toggle="tooltip" 
                                                            title="Delete Question"
                                                            onclick="return confirm('Are you sure you want to delete this question?')">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info modern-alert">
                        <i class="fas fa-info-circle"></i>
                        {{ trans('admin/checklists/general.no_questions') }}
                    </div>
                @endif
            </div>

            <div class="box-footer">
                <a href="{{ route('checklists.index') }}" class="btn btn-default back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Checklists
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('moar_scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<style>
.modern-table {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.modern-table thead th {
    background: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
    color: #495057;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    padding: 12px 15px;
}

.modern-table tbody tr {
    border-bottom: 1px solid #f2f2f2;
    transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.modern-table td {
    padding: 12px 15px;
    vertical-align: middle;
    color: #333;
}

.box-heading {
    display: flex;
    align-items: center;
    gap: 15px;
}

.box-subtitle {
    margin-left: 10px;
}

.question-text {
    color: #2c3e50;
    font-weight: 500;
    font-size: 14px;
}

.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.badge-type {
    background: #e3f2fd;
    color: #1976d2;
}

.badge-text {
    background: #e8f5e9;
    color: #2e7d32;
}

.badge-boolean {
    background: #fff3e0;
    color: #ef6c00;
}

.badge-number {
    background: #f3e5f5;
    color: #7b1fa2;
}

.action-btn {
    background: white;
    border: 1px solid #e0e0e0;
    padding: 5px 10px;
    margin: 0 2px;
    transition: all 0.2s ease;
}

.action-btn:hover {
    background: #f8f9fa;
    border-color: #d0d0d0;
    transform: translateY(-1px);
}

.box {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    background: white;
    margin-bottom: 20px;
}

.box-header {
    border-bottom: 1px solid #f2f2f2;
    padding: 15px 20px;
}

.box-title {
    font-size: 18px;
    color: #2c3e50;
}

.box-body {
    padding: 20px;
}

.box-footer {
    padding: 15px 20px;
    border-top: 1px solid #f2f2f2;
    background: #f8f9fa;
    border-radius: 0 0 8px 8px;
}

.back-btn {
    color: #666;
    transition: all 0.2s ease;
}

.back-btn:hover {
    color: #333;
    transform: translateX(-2px);
}

.modern-alert {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 10px;
}

.text-muted {
    color: #6c757d;
    font-size: 13px;
}
</style> 