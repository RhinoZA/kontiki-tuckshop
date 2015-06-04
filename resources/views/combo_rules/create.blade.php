<!DOCTYPE html>
<html lang="en" ng-app="kitchenApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/kitchen.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dark-theme.css') }}" rel="stylesheet">
		
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>		

	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		
	<script>
	angular.module('kitchenApp', []).controller('kitchenCtl', function($scope, $http) {

	    var self = {};

	    $scope.app = self;

	    self.http = $http;
	    
	    self.product_id = {!! $product->id !!};
	    self.la_combo_types = {!! $combo_types !!};
	    
	     angular.forEach(self.la_combo_types, function(la_combo_type) {
	         self.combo_types.push(new combo_type(self, la_combo_type.name))
	     });
	    
	    self.combo_rules = [];
	    self.combo_types = [];
        
        self.add_new_combo_rule = function() {
            self.combo_rules.push(new combo_rule(self));
            
        }
        
    });
    
    function combo_rule(app, combo_type_id) {
        var self = this;
        self.app = app;
        self.combo_type_id = combo_type_id;
        
        self.remove = function () {
            var index = self.app.combo_rules.indexOf(self);
            self.app.combo_rules.splice(index, 1);
        }
    }
    
    function combo_type(app, name) {
        
        var self = this;
        
        self.app = app;
        
        self.name = name;
        
        self.remove = function () {
            var index = self.app.combo_types.indexOf(self);
            self.app.combo_types.splice(index, 1);
        }
        
    }

</script>
</head>

<body ng-controller="kitchenCtl">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a>
                    </li>
                    <li><a href="{{ url('/auth/register') }}">Register</a>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <h1 ng-bind="app.product_id"></h1>
    <div class="container">
        <div id="content">
            <div ng-repeat="combo_rule in app.combo_rules">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        Combo 
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>

</html>