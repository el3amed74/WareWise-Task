@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('admin/checklists/general.create') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('checklists.index') }}" class="btn btn-primary pull-right">
        {{ trans('general.back') }}
    </a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">{{ trans('admin/checklists/general.create') }}</h2>
            </div>

            <div class="box-body">
                <form class="form-horizontal" method="POST" action="{{ route('checklists.store') }}" autocomplete="off">
                    @csrf

                    <div class="form-group {{ $errors->has('name') ? 'error' : '' }}">
                        <label for="name" class="col-md-3 control-label">{{ trans('Name') }}</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" />
                            {!! $errors->first('name', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('type') ? 'error' : '' }}">
                        <label for="type" class="col-md-3 control-label">{{ trans('Type') }}</label>
                        <div class="col-md-7">
                            <select class="form-control" name="type" id="type">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                            {!! $errors->first('type', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="text-left col-md-6">
                            <a class="btn btn-link" href="{{ route('checklists.index') }}">{{ trans('button.cancel') }}</a>
                        </div>
                        <div class="text-right col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check icon-white" aria-hidden="true"></i>
                                {{ trans('general.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop 