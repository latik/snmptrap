@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New Point</h1>
    <hr/>

    {!! Form::open(['route' => 'point.store', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
                {!! Form::label('district_id', trans('point.district_id'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('district_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('district_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
                {!! Form::label('district', trans('point.district'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('district', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('street') ? 'has-error' : ''}}">
                {!! Form::label('street', trans('point.street'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('street', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('street', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('building') ? 'has-error' : ''}}">
                {!! Form::label('building', trans('point.building'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('building', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('building', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('entrance') ? 'has-error' : ''}}">
                {!! Form::label('entrance', trans('point.entrance'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('entrance', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('entrance', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', trans('point.status'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ip') ? 'has-error' : ''}}">
                {!! Form::label('ip', trans('point.ip'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('ip', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('ip', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('port') ? 'has-error' : ''}}">
                {!! Form::label('port', trans('point.port'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('port', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('port', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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