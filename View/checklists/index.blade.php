@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('Checklists') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('checklists.create') }}" class="btn btn-primary pull-right">
        <i class="fas fa-plus"></i> {{ trans('Create Checklist') }}
    </a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover modern-table">
                        <thead>
                            <tr>
                                <th class="col-md-4">{{ trans('Name') }}</th>
                                <th class="col-md-2">{{ trans('Type') }}</th>
                                <th class="col-md-2">{{ trans('Created_at') }}</th>
                                <th class="col-md-2">{{ trans('Questions') }}</th>
                                <th class="col-md-2">{{ trans('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checklists as $checklist)
                            <tr>
                                <td>
                                    <div class="checklist-name">
                                        <strong>{{ $checklist->name }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-type">{{ ucfirst($checklist->type) }}</span>
                                </td>
                                <td>{{ $checklist->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <span class="badge badge-count">
                                        {{ $checklist->questions()->count() }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('checklists.questions.index', $checklist) }}" 
                                           class="btn btn-sm btn-default action-btn" 
                                           data-toggle="tooltip" 
                                           title="View Questions">
                                            <i class="fas fa-list text-info"></i>
                                        </a>
                                        <a href="{{ route('checklists.edit', $checklist) }}" 
                                           class="btn btn-sm btn-default action-btn"
                                           data-toggle="tooltip" 
                                           title="Edit Checklist">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        <form action="{{ route('checklists.destroy', $checklist) }}" 
                                              method="POST" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-default action-btn" 
                                                    data-toggle="tooltip" 
                                                    title="Delete Checklist"
                                                    onclick="return confirm('Are you sure you want to delete this checklist?')">
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

.checklist-name {
    color: #2c3e50;
    font-size: 14px;
}

.badge-type {
    background: #e3f2fd;
    color: #1976d2;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
}

.badge-count {
    background: #f5f5f5;
    color: #616161;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
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
</style>
@stop 