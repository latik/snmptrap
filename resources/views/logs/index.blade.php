@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Logs <a href="{{ url('/logs/create') }}" class="btn btn-primary btn-xs" title="Add New Log"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ trans('log.level') }} </th>
                    <th>{{ trans('log.message') }} </th>
                    <th>{{ trans('log.time') }} </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($logs as $item)
                <tr>
                    <td>{{ $item->level_name }}</td>
                    <td>{{ $item->message }}</td>
                    <td>{{ $item->created_at }}</td>

                    <td>
                        <a href="{{ url('/logs/' . $item->id) }}" class="btn btn-success btn-xs" title="View Log"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/logs/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Log"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/logs', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Log" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Log',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $logs->render() !!} </div>
    </div>

</div>
@endsection
