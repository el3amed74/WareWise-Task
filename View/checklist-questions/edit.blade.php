@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('Edit Question') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('checklists.questions.index', $checklistQuestion->checklist_id) }}" class="btn btn-primary pull-right">
        <i class="fas fa-arrow-left"></i> {{ trans('general.back') }}
    </a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
           
            </div>

            <div class="box-body">
                <form class="form-horizontal" method="POST" action="{{ route('checklist-questions.update', $checklistQuestion) }}" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="col-md-3 control-label">{{ trans('Checklist') }}</label>
                        <div class="col-md-7">
                            <p class="form-control-static">
                                <span class="badge badge-type">{{ $checklistQuestion->checklist_name }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                        <label for="question" class="col-md-3 control-label">{{ trans('Question') }}</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-question-circle"></i></span>
                                <input class="form-control" type="text" name="question" id="question" value="{{ old('question', $checklistQuestion->question) }}" required />
                            </div>
                            {!! $errors->first('question', '<span class="help-block"><i class="fas fa-times"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                        <label for="comment" class="col-md-3 control-label">{{ trans('Answer Type') }}</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-list-alt"></i></span>
                                <select class="form-control" name="comment" id="comment" required>
                                    <option value="Text Answer" {{ old('comment', $checklistQuestion->comment) == 'Text Answer' ? 'selected' : '' }}>Text Answer</option>
                                    <option value="Number Answer" {{ old('comment', $checklistQuestion->comment) == 'Number Answer' ? 'selected' : '' }}>Number Answer</option>
                                    <option value="Yes/No Answer" {{ old('comment', $checklistQuestion->comment) == 'Yes/No Answer' ? 'selected' : '' }}>Yes/No Answer</option>
                                </select>
                            </div>
                            {!! $errors->first('comment', '<span class="help-block"><i class="fas fa-times"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="text-left col-md-6">
                            <a class="btn btn-link" href="{{ route('checklists.questions.index', $checklistQuestion->checklist_id) }}">
                                <i class="fas fa-times"></i> {{ trans('button.cancel') }}
                            </a>
                        </div>
                        <div class="text-right col-md-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> {{ trans('general.update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('moar_scripts')
<style>
.box {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    background: white;
    transition: all 0.2s ease;
}

.box:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

.form-control {
    border-radius: 4px;
    border: 1px solid #e0e0e0;
    box-shadow: none;
    font-size: 14px;
    height: 38px;
    padding: 8px 12px;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 2px rgba(52,152,219,0.1);
}

.input-group-addon {
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    color: #666;
}

.help-block {
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
}

.has-error .form-control {
    border-color: #dc3545;
}

.has-error .input-group-addon {
    border-color: #dc3545;
    background: #fff5f5;
    color: #dc3545;
}

.btn {
    border-radius: 4px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-success {
    background: #2ecc71;
    border-color: #27ae60;
}

.btn-success:hover {
    background: #27ae60;
    border-color: #219a52;
    transform: translateY(-1px);
}

.btn-link {
    color: #666;
}

.btn-link:hover {
    color: #333;
    text-decoration: none;
}

.box-footer {
    background: #f8f9fa;
    border-top: 1px solid #f2f2f2;
    padding: 15px 20px;
    border-radius: 0 0 8px 8px;
}

select.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 11.5l-5-5h10l-5 5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 30px;
}

.badge-type {
    background: #e3f2fd;
    color: #1976d2;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
}

.form-control-static {
    padding-top: 7px;
}
</style>
@stop 