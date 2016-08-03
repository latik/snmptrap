@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                @foreach ($dashboards as $board)
                    <li role="presentation" @if ($board->id === $active) class="active" @endif  >
                        <a href="#" aria-controls="page-{{ $board->id }}" role="tab"
                           data-toggle="tab" data-dashboard="{{ $board->id }}">{{ $board->title }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                @foreach ($dashboards as $board)
                    <div role="tabpanel" class="tab-pane fade @if ($board->id === $active) in active @endif"
                         id="home-{{ $board->id }}">
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
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>var filter = {{ $active }};</script>
@endsection