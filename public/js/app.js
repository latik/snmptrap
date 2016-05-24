/**
 * Created by o.latkovskyi on 18.05.2016.
 */
'use strict';

var restEndpoint = 'http://switches.zap.odeko.serv/monit/public/ports';

angular
    .module('portApp',[])
    .controller('mainController', function($scope, $http, port) {
        $scope.portData = {};
        port.get()
            .success(function(data) {
                $scope.ports = data;
            });
        $scope.submitport = function() {
            port.save($scope.portData)
                .success(function() {
                    port.get()
                        .success(function(getData) {
                            $scope.ports = getData;
                        });
                })
                .error(function(data) {
                    console.log(data);
                });
        };
        $scope.editport = function(id) {
            port.update(id)
                .success(function() {
                    port.get()
                        .success(function(getData) {
                            $scope.ports = getData;
                        });
                });
        };
        $scope.deleteport = function(id) {
            port.destroy(id)
                .success(function() {
                    port.get()
                        .success(function(getData) {
                            $scope.ports = getData;
                        });
                });
        };
    })
    .factory('port', function($http) {
        return {
            get : function() {
                return $http.get(restEndpoint);
            },
            save : function(portData) {
                return $http({
                    method: 'POST',
                    url: restEndpoint,
                    data: $.param(portData)
                });
            },
            update : function(id,portData) {
                return $http({
                    method: 'PUT',
                    url: restEndpoint + id,
                    data: {'id': id, 'data': $.edit(portData)}
                });
            },
            destroy : function(id) {
                return $http.delete(restEndpoint + id);
            }
        }
    });