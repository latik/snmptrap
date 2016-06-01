@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="districtTabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#home" aria-controls="home" role="tab"
                       data-toggle="tab" data-district="1">EdgeCore3510 Шевченковский</a>
                </li>
                <li role="presentation">
                    <a href="#profile" aria-controls="profile" role="tab"
                       data-toggle="tab" data-district="2">Бородинский</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home">
                    <table id="commutator_table" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ trans('point.guard') }} </th>
                            <th> {{ trans('point.name') }} </th>
                            <th> {{ trans('point.status') }} </th>
                            <th> {{ trans('point.updated_at') }} </th>
                            <th> {{ trans('point.confirm') }} </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="profile">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <table id="commutator_table" class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{ trans('point.district_id') }} </th>
                                <th> {{ trans('point.name') }} </th>
                                <th> {{ trans('point.status') }} </th>
                                <th> {{ trans('point.updated_at') }} </th>
                                <th> {{ trans('point.confirm') }} </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var filter = 1;
    </script>
    <script src="/js/getstatus.js"></script>
@endsection