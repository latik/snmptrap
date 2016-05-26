@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Netdevice {{ $netdevice->id }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th><td>{{ $netdevice->id }}</td>
                </tr>
                <tr><th> {{ trans('netdevice.city') }} </th><td> {{ $netdevice->city }} </td></tr><tr><th> {{ trans('netdevice.new_district') }} </th><td> {{ $netdevice->new_district }} </td></tr><tr><th> {{ trans('netdevice.street_name') }} </th><td> {{ $netdevice->street_name }} </td></tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('netdevice/' . $netdevice->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Netdevice"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['netdevice', $netdevice->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Netdevice',
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