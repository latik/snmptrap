@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Point {{ $point->id }}</h1>
    <p><a href="{{ route('point.index') }}" class="btn btn-info">Back to all</a></p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $point->id }}</td>
                </tr>
                <tr>
                    <th> {{ trans('point.name') }} </th>
                    <td> {{ $point->name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.district_id') }} </th>
                    <td> {{ $point->district_id }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.district') }} </th>
                    <td> {{ $point->district }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.street') }} </th>
                    <td> {{ $point->street }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.building') }} </th>
                    <td> {{ $point->building }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.entrance') }} </th>
                    <td> {{ $point->entrance }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.status') }} </th>
                    <td> {{ $point->status }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.ip') }} </th>
                    <td> {{ $point->ip }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.port') }} </th>
                    <td> {{ $point->port }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.updated_at') }} </th>
                    <td> {{ $point->updated_at }} </td>
                </tr>
                <tr>
                    <th> {{ trans('point.created_at') }} </th>
                    <td> {{ $point->created_at }} </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ route('point.edit', $point->id) }}" class="btn btn-primary btn-xs" title="Edit Point"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['point.destroy', $point->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Point',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
@endsection