
var app = angular.module("MyTutorialApp", []);


/*
app.controller("MainController", function($scope){

});

app.controller("Customers", function($scope){
	$scope.myName = "";
	$scope.customers = [
		{name:'John Smith', city:'JoS'}, 
		{name: 'Jane Smith', city:'JaS'}, 
		{name: 'John Doe', city:'JoD'}, 
		{name: 'Jane Doe', city:'JaD'}
	];

});
*/

app.config(function($routeProvider){
	$routeProvider
	.when("/", 
	{
		controller: 'SimpleController',
		templateUrl: 'Partials/View2.html'
	})
	.when("/view2", 
	{
		controller: 'Customers',
		templateUrl: 'Partials/View1.html'
	})
	.when("/student",
	{
		controller: "Student",
		templateUrl: "student.htm",
	})
	.otherwise({redirectTo: "/"});
});

var controllers = {};

controllers.Customers = function($scope) {
	$scope.myName = "";
	$scope.customers = [
		{name: 'John Smith', city:'JoS'}, 
		{name: 'Jane Smith', city:'JaS'}, 
		{name: 'John Doe', city:'JoD'}, 
		{name: 'Jane Doe', city:'JaD'}
	];

};

addCustomer = function($scope) {
	$scope.customers.push(
	{
		name: $scope.newCustomer.name,
		city: $scope.newCustomer.city
	});
};

controllers.Something = function( $scope ) {
	//$scope.
	console.log("scope", $scope);
	$scope.something = {
		mn: "this is mn",
		some: [
			{a: "aa"},
			{a: "bb"},
			{a: "cc"},
			{a: "ss"},
		]
	};
	
	//$scope.
	
	return $scope.something;
};

controllers.Studentform = function($scope) {
	
};

controllers.Student = function($scope) {
	$scope.total = 100;
};


app.controller(controllers);

console.log(app);

