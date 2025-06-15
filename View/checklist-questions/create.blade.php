@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('Add question') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('checklists.questions.index', $checklist) }}" class="btn btn-primary pull-right">
        {{ trans('general.back') }}
    </a>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            

            <div class="box-body">
                <form class="form-horizontal" method="POST" action="{{ route('checklists.questions.store', $checklist) }}" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label class="col-md-3 control-label">{{ trans('Checklist') }}</label>
                        <div class="col-md-7">
                            <p class="form-control-static">{{ $checklist->name }}</p>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('question') ? 'error' : '' }}">
                        <label for="question" class="col-md-3 control-label">{{ trans('Question') }}</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="question" id="question" value="{{ old('question') }}" required />
                            {!! $errors->first('question', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('comment') ? 'error' : '' }}">
                        <label for="comment" class="col-md-3 control-label">{{ trans('Answer Type') }}</label>
                        <div class="col-md-7">
                            <select class="form-control" name="comment" id="comment" required>
                                <option value="Text Answer" {{ old('comment') == 'Text Answer' ? 'selected' : '' }}>Text Answer</option>
                                <option value="Number Answer" {{ old('comment') == 'Number Answer' ? 'selected' : '' }}>Number Answer</option>
                                <option value="Yes/No Answer" {{ old('comment') == 'Yes/No Answer' ? 'selected' : '' }}>Yes/No Answer</option>
                            </select>
                            {!! $errors->first('comment', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="text-left col-md-6">
                            <a class="btn btn-link" href="{{ route('checklists.questions.index', $checklist) }}">{{ trans('button.cancel') }}</a>
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