@extends('layouts.app')

@section('content')
<div class="container">
    <table id="commutator_table" class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th> {{ trans('point.district_id') }} </th>
            <th> {{ trans('point.district') }} </th>
            <th> {{ trans('point.street') }} </th>
            <th> {{ trans('point.building') }} </th>
            <th> {{ trans('point.entrance') }} </th>
            <th> {{ trans('point.status') }} </th>
            <th> {{ trans('point.updated_at') }} </th>
            <th> {{ trans('point.confirm') }} </th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="/js/getstatus.js"></script>
@endsection