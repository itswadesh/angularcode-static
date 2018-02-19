app = angular.module('app', []);
app.controller("NavCtrl",function($scope,$http){
	var serviceBase = 'api/v1/';
	$http.get(serviceBase + 'categories').then(function (results) {
        $scope.categories = results.data;
    });
});