@extends('layouts.app')

@section('content')
<div class="container">

    <h1>User {{ $user->id }}
        <a href="{{ url('user/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['user', $user->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th> {{ trans('user.name') }} </th>
                    <td> {{ $user->name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('user.email') }} </th>
                    <td> {{ $user->email }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
