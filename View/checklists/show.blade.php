@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ $checklist->name }}
    @parent
@stop

@section('header_right')
    <div class="btn-group pull-right">
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">{{ trans('button.actions') }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ route('checklists.edit', $checklist->id) }}">{{ trans('admin/checklists/general.edit') }}</a></li>
            <li><a href="{{ route('checklists.questions.create', $checklist->id) }}">{{ trans('admin/checklists/general.add_question') }}</a></li>
        </ul>
    </div>
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">{{ $checklist->name }}</h2>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>{{ trans('general.name') }}:</td>
                                        <td>{{ $checklist->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('general.description') }}:</td>
                                        <td>{{ $checklist->description }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('general.status') }}:</td>
                                        <td>
                                            @if($checklist->status == 'active')
                                                <span class="label label-success">{{ trans('general.active') }}</span>
                                            @else
                                                <span class="label label-danger">{{ trans('general.inactive') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('general.created_at') }}:</td>
                                        <td>{{ $checklist->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('general.updated_at') }}:</td>
                                        <td>{{ $checklist->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3>{{ trans('admin/checklists/general.questions') }}</h3>
                        @if($checklist->questions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('general.question') }}</th>
                                            <th>{{ trans('general.type') }}</th>
                                            <th>{{ trans('general.order') }}</th>
                                            <th>{{ trans('general.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($checklist->questions as $question)
                                            <tr>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ ucfirst($question->type) }}</td>
                                                <td>{{ $question->order }}</td>
                                                <td>
                                                    <a href="{{ route('checklist-questions.edit', $question->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('checklist-questions.destroy', $question->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ trans('general.delete_confirm') }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                {{ trans('admin/checklists/general.no_questions') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('checklists.questions.create', $checklist->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ trans('admin/checklists/general.add_question') }}
                </a>
            </div>
        </div>
    </div>
</div>
@stop 