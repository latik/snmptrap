@extends('layouts.app')

@section('content')
<div class="container">


    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="Tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="/point">Точки</a>
            </li>
            <li role="presentation">
                <a href="{{ url('/point/create') }}">Добавить новую</a>
            </li>
            <li role="presentation">
                <a href="{{ url('/import') }}">Импорт</a>
            </li>
        </ul>
    </div>

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>id</th>
                    <th> {{ trans('point.name') }} </th>
                    <th> {{ trans('point.ip') }} </th>
                    <th> {{ trans('point.port') }} </th>
                    <th> {{ trans('point.status') }} </th>
                    <th> {{ trans('point.updated_at') }} </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($point as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->port }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('point.show', $item->id) }}" class="btn btn-success btn-xs" title="View Point"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ route('point.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Edit Point"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['point.destroy', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Point" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Point',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )); !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $point->render() !!} </div>
    </div>

</div>
@endsection
