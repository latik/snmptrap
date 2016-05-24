@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2" ng-app="portApp" ng-controller="mainController">

        <form ng-submit="submitport()"> <!-- ng-submit will disable the default form action and use our function -->

            <div class="form-group">
                <input type="text" class="form-control input-lg" name="port" ng-model="portData.title" placeholder="what you want to do?">
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>

        <!-- show loading icon if the loading variable is set to true -->
        <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

        <!-- hide these ports if the loading variable is true -->
        <div class="port" ng-hide="loading" ng-repeat="port in ports">
            <h6>#@{{ port.id }} @{{ port.district }}</h6>
            <p>
                <a href="#" ng-click="deleteport(port.id)" class="text-muted">Delete</a>
                <a href="#" ng-click="editport(port.id)" class="text-muted">Edit</a>
            </p>
        </div>
    </div>
</div>
@endsection