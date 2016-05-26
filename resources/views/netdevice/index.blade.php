@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Netdevice <a href="{{ url('/netdevice/create') }}" class="btn btn-primary btn-xs" title="Add New Netdevice"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> {{ trans('netdevice.city') }} </th><th> {{ trans('netdevice.new_district') }} </th><th> {{ trans('netdevice.street_name') }} </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($netdevice as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->city }}</td><td>{{ $item->new_district }}</td><td>{{ $item->street_name }}</td>
                    <td>
                        <a href="{{ url('/netdevice/' . $item->id) }}" class="btn btn-success btn-xs" title="View Netdevice"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/netdevice/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Netdevice"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/netdevice', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Netdevice" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Netdevice',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $netdevice->render() !!} </div>
    </div>

</div>
@endsection
