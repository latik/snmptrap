@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Dashboard {{ $dashboard->id }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                <tr>
                    <th>ID.</th>
                    <td>{{ $dashboard->id }}</td>
                </tr>
                <tr>
                    <th> {{ trans('dashboard.title') }} </th>
                    <td> {{ $dashboard->title }} </td>
                </tr>
                <tr>
                    <th> {{ trans('dashboard.sql') }} </th>
                    <td> {{ $dashboard->sql }} </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('dashboard/' . $dashboard->id . '/edit') }}" class="btn btn-primary btn-xs"
                           title="Edit Dashboard"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['dashboard', $dashboard->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete Dashboard',
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