var SonataAngularApp = angular.module('SonataAngularApp', []);

SonataAngularApp.controller('MenuCtrl', ['$scope', '$location', function ($scope, $location) {
    $scope.menu = [
        {name: 'List', uri: '#/list', navClass: "list"},
        {name: 'Create', uri: '#/new', navClass: "new"}
    ];
    
    $scope.navClass = function (page) {
        var currentRoute = $location.path().substring(1) || 'home';
        return page === currentRoute ? 'active' : '';
    }; 
}]);

SonataAngularApp.controller('ListCtrl', ['$scope', '$routeParams', '$http', function ($scope, $routeParams, $http) {
    //Routing.generate('acme_simplecms_crud_list', {"_format": 'json'})
  $http({
      method: "GET",
      url: "/posts.json"
  })
  .success(function(data, status, headers, config) {
      $scope.posts = data;
  })
  .error(function(data, status, headers, config) {
      alert(data, status);
  });
}]);

SonataAngularApp.controller('EditCtrl', ['$scope', '$routeParams', function ($scope, $routeParams) {
    $scope.postId = $routeParams.postId;
}]);

SonataAngularApp.controller('ShowCtrl', ['$scope', '$routeParams', function ($scope, $routeParams) {
    $scope.postId = $routeParams.postId;
}]);

SonataAngularApp.controller('CreateCtrl', ['$scope', '$routeParams', '$http', '$location', function ($scope, $routeParams, $http, $location) {
    $scope.master= {};
    
    $http({
        method: "GET",
        url: "/users.json"
    }).success(function(data) {
        $scope.users = data;
    });
    
    $http({
        method: "GET",
        url: "/categories.json"
    }).success(function(data) {
        $scope.categories = data;
    });
    
    $http({
        method: "GET",
        url: "/tags.json"
    }).success(function(data) {
        $scope.tags = data;
    });

    $scope.update = function(post) {
        $scope.master= angular.copy(post);
        $http({
            method: "POST",
            url: "/posts",
            data: $scope.master
        }).success(function(data, status) {
            $location.url("/list");
        }).error(function(data, status) {
            alert(data, status);
        });
    };
}]);

//routing

SonataAngularApp.config(['$routeProvider', function($routeProvider) {
    $routeProvider.
        when('/list', {templateUrl: Routing.generate("partials", {"name": "list"}), controller: "ListCtrl"}).
        when('/new', {templateUrl: Routing.generate("partials", {"name": "create"}), controller: "CreateCtrl"}).
        when('/show/:postId', {templateUrl: Routing.generate("partials", {"name": "show"}), controller: "ShowCtrl"}).
        when('/edit/:postId', {templateUrl: Routing.generate("partials", {"name": "edit"}), controller: "EditCtrl"}).
        otherwise({redirectTo: '/'});
}]);
