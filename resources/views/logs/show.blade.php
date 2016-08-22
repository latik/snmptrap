@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Log {{ $log->id }}
        <a href="{{ url('logs/' . $log->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Log"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['logs', $log->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Log',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>{{ trans('log.level') }} </th>
                <th>{{ trans('log.message') }} </th>
                <th>{{ trans('log.time') }} </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $log->level_name }}</td>
                    <td>{{ $log->message }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
