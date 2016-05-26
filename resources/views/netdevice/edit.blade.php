@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Netdevice {{ $netdevice->id }}</h1>

    {!! Form::model($netdevice, [
        'method' => 'PATCH',
        'url' => ['/netdevice', $netdevice->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                {!! Form::label('city', trans('netdevice.city'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('new_district') ? 'has-error' : ''}}">
                {!! Form::label('new_district', trans('netdevice.new_district'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('new_district', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('new_district', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('street_name') ? 'has-error' : ''}}">
                {!! Form::label('street_name', trans('netdevice.street_name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('street_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('street_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('house_name') ? 'has-error' : ''}}">
                {!! Form::label('house_name', trans('netdevice.house_name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('house_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('house_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('doorway') ? 'has-error' : ''}}">
                {!! Form::label('doorway', trans('netdevice.doorway'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('doorway', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('doorway', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('house_id') ? 'has-error' : ''}}">
                {!! Form::label('house_id', trans('netdevice.house_id'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('house_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('house_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ip') ? 'has-error' : ''}}">
                {!! Form::label('ip', trans('netdevice.ip'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('ip', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('ip', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('mac') ? 'has-error' : ''}}">
                {!! Form::label('mac', trans('netdevice.mac'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('mac', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('mac', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('dev_name') ? 'has-error' : ''}}">
                {!! Form::label('dev_name', trans('netdevice.dev_name'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('dev_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('dev_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sw_role') ? 'has-error' : ''}}">
                {!! Form::label('sw_role', trans('netdevice.sw_role'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('sw_role', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('sw_role', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('vendor_model') ? 'has-error' : ''}}">
                {!! Form::label('vendor_model', trans('netdevice.vendor_model'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('vendor_model', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('vendor_model', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('inventary_state') ? 'has-error' : ''}}">
                {!! Form::label('inventary_state', trans('netdevice.inventary_state'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('inventary_state', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('inventary_state', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('community') ? 'has-error' : ''}}">
                {!! Form::label('community', trans('netdevice.community'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('community', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('community', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('vlan') ? 'has-error' : ''}}">
                {!! Form::label('vlan', trans('netdevice.vlan'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('vlan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('vlan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('mon_type') ? 'has-error' : ''}}">
                {!! Form::label('mon_type', trans('netdevice.mon_type'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('mon_type', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('mon_type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('port_number') ? 'has-error' : ''}}">
                {!! Form::label('port_number', trans('netdevice.port_number'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('port_number', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('port_number', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('parent_mac') ? 'has-error' : ''}}">
                {!! Form::label('parent_mac', trans('netdevice.parent_mac'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('parent_mac', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('parent_mac', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('parent_port') ? 'has-error' : ''}}">
                {!! Form::label('parent_port', trans('netdevice.parent_port'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('parent_port', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('parent_port', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('abon_current') ? 'has-error' : ''}}">
                {!! Form::label('abon_current', trans('netdevice.abon_current'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('abon_current', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('abon_current', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('s_level') ? 'has-error' : ''}}">
                {!! Form::label('s_level', trans('netdevice.s_level'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('s_level', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('s_level', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection