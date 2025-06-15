@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('Update Checklist') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('checklists.index') }}" class="btn btn-primary pull-right">
        <i class="fas fa-arrow-left"></i> {{ trans('general.back') }}
    </a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            

            <div class="box-body">
                <form class="form-horizontal" method="POST" action="{{ route('checklists.update', $checklist->id) }}" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="col-md-3 control-label">{{ trans('general.name') }}</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-clipboard-list"></i></span>
                                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $checklist->name) }}" />
                            </div>
                            {!! $errors->first('name', '<span class="help-block"><i class="fas fa-times"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="type" class="col-md-3 control-label">{{ trans('Type') }}</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
                                <select class="form-control" name="type" id="type">
                                    <option value="daily" {{ old('type', $checklist->type) == 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ old('type', $checklist->type) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ old('type', $checklist->type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="quarterly" {{ old('type', $checklist->type) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                    <option value="yearly" {{ old('type', $checklist->type) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                </select>
                            </div>
                            {!! $errors->first('type', '<span class="help-block"><i class="fas fa-times"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="text-left col-md-6">
                            <a class="btn btn-link" href="{{ route('checklists.index') }}">
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
</style>
@stop 