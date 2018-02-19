'use strict';

angular.module('sendmailApp', [])
.controller('MailController', function ($scope,$http) {
  $scope.loading = false;
  $scope.mail = {to: ''};
  $scope.send = function (mail){
    $scope.loading = true;
    $http.post('api/index.php?email='+mail.to).then(res=>{
        $scope.loading = false;
        console.log(res);
        $scope.serverMessage = 'Email sent with attachment';
    });
  }
})
