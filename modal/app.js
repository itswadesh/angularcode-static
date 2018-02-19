angular.module('demoApp',['ngMaterial'])
.controller('MainController', function($scope,$mdDialog){
  $scope.showDialog = function(){
  $mdDialog.show({
        templateUrl: 'modal.html',
        controller: function($scope, $mdDialog) {
            $scope.hide = function() {
              console.log('Modal was hidden.');
              $mdDialog.hide();
            };
            $scope.cancel = function() {
              console.log('Modal cancelled.');
              $mdDialog.cancel();
            };
            $scope.answer = function(mail) {
              console.log('Action done.');
              $mdDialog.hide(mail);
            };
        }
      }).then(function(answer) {
          $scope.alert = 'You said you ' + answer + '.';
      }, function() {
          $scope.alert = 'You cancelled the dialog.';
      });
    }
});