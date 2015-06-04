<!DOCTYPE html>
<html lang="en" ng-app="ordersApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kontiki</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/order.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dark-theme.css') }}" rel="stylesheet">
		
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		
	<script>
	angular.module('ordersApp', []).controller('ordersCtl', function($scope, $http) {

	    var self = {};

	    $scope.app = self;

	    self.http = $http;
	    self.products = [];
	    self.product_groups = [];
	    self.order = new order(self);
	    self.active_product_group = null;
	    self.combos = [];
	    //self.combo_products = {};
	    self.combo_types_in_combos = {};//index of combo lists indexed by combo type
	    self.combos_index = {};
	    self.products_index = {};

	    var la_product_groups = {!!$products!!};
	    var la_combo_rules = {!! $combo_rules !!};
	    
	    console.log(la_combo_rules);
	    
	    angular.forEach(la_product_groups, function(la_product_group) {
	        var new_product_group = new product_group(la_product_group.id, la_product_group.name, la_product_group.products, self);
	        self.product_groups.push(new_product_group);
	        if (self.active_product_group == null) {
	            self.active_product_group = new_product_group;
	        }
	    });

	    angular.forEach(la_combo_rules, function(la_combo_rule) {
	        var new_combo_rule = new combo_rule(la_combo_rule);
	        if (self.combos_index.hasOwnProperty(la_combo_rule.product_id) ) {
	        	var combo = self.combos_index[la_combo_rule.product_id];
	        	combo.combo_rules.push(new_combo_rule);
	        	new_combo_rule.combo = combo;
	        	if (!self.combo_types_in_combos.hasOwnProperty(new_combo_rule.combo_type_id) ) {
	        		self.combo_types_in_combos[new_combo_rule.combo_type_id] = [];
	        	}
	        	self.combo_types_in_combos[new_combo_rule.combo_type_id].push(combo); 
	        }
	        
	    });
	    
	});


	function product_group(id, name, la_products, app) {

	    var self = this;
	    self.id = id;
	    self.name = name;
	    self.products = [];
	    self.app = app;

	    angular.forEach(la_products, function(la_product) {
	    	//Todo add combo to app.combos  app.combos.
	    	var new_product = new product(la_product, app);
	    	if (new_product.product_type_id != 3) {//combo type
	    		self.products.push(new_product);	
	    	}
	    });

	    self.activate = function() {
	        self.app.active_product_group = self;
	    }
	};

	function product(la_product, app) {

	    var self = this;
	    self.id = la_product.id;
	    self.name = la_product.name;
	    self.selling_price = la_product.selling_price;
	    self.app = app;
	    self.combo_rules = [];
	    self.combo_type_id = la_product.combo_type_id;

		self.product_type_id = la_product.product_type_id;
			    	self.app.products_index[self.id] = self;
			    	
	    if (self.product_type_id == 3) {//combo type = 3
	    	self.app.combos.push(self);
	    	self.app.combos_index[self.id] = self;
	    } 
	    	
	    self.add_to_order = function() {

			var found_order_item = self.add_to_order_without_calculate();
			app.order.calculate();
	        return found_order_item;
	        
	    }
	    
	    self.add_to_order_without_calculate = function() {
	    	var found_order_item = null;
			
	        angular.forEach(app.order.order_items, function(order_item) {
	            if (order_item.product == self) {
	                order_item.increment_without_calculate();
	                found_order_item = order_item;
	            }
	        });

			if (found_order_item == null) {
				found_order_item = new order_item(self, app.order);
	        	app.order.order_items.push(found_order_item);
			}
			
	        return found_order_item;
	    }

	};


	function combo_rule(la_combo_rule) {
		var self = this;
		
		self.combo = null;
		self.combo_type_id = la_combo_rule.combo_type_id;
	};
	
	function order(app) {
	    var self = this;

	    self.order_items = [];
	    self.total = 0;
	    self.app = app;
	    self.tender = null;
	    self.change = 0;

	    self.checkout = function() {
	        var items = [];

	        angular.forEach(self.order_items, function(order_item) {
	            items.push({
	                "product_id": order_item.product.id,
	                "quantity": order_item.quantity
	            });
	        });

	        console.log(angular.toJson(items));

	        self.app.http({
	            url: '/orders',
	            method: "POST",
	            data: angular.toJson(items),
	            headers: {
	                'Content-Type': 'application/json'
	            }
	        }).success(function(data, status, headers, config) {
	            self.app.confirmed_order = data;
	            console.log(data);
	            $("#confirmed_order_modal").modal('show');
	            self.clear();
	        }).error(function(data, status, headers, config) {
	            self.app.error_status = status + ' ' + headers;
	            $("#error").modal('show');
	        });

	    };

	    self.clear = function() {
	        self.order_items = [];
	        self.tender = null;
	        self.calculate();
	    }

	    self.calculate = function() {
	        self.total = 0;
	        
	        self.check_for_combos();
	        
	        angular.forEach(self.order_items, function(order_item) {
	            self.total = self.total + (order_item.product.selling_price * order_item.quantity)
	        });
	        self.total = Math.round(self.total * 100, 2) / 100;
	        if (!isNaN(self.tender) && self.tender != 0.0 && self.tender != null) {
	            self.change = "R " + (self.tender - self.total);
	        }
	        else {
	            self.change = "";
	        }
	    };
	    
	    self.check_for_combos = function() {
	    	angular.forEach(self.order_items, function(order_item) {
	    		//Check if order_item is part of a combo
	            if (self.app.combo_types_in_combos.hasOwnProperty(order_item.product.combo_type_id)) {
	            	var combos = self.app.combo_types_in_combos[order_item.product.combo_type_id];
	            	angular.forEach(combos, function(combo) {
	            		var found_required_items = true;
	            		var required_order_items = [];
	            		angular.forEach(combo.combo_rules, function(combo_rule) {
	            			var found_required_item = false;
	            			angular.forEach(self.order_items, function(test_order_item) {
	            				if (combo_rule.combo_type_id == test_order_item.product.combo_type_id && found_required_item == false && test_order_item.part_of_combo_instances.length < test_order_item.quantity) {
	            					required_order_items.push(test_order_item);
	            					found_required_item = true;
	            				}
	            			});
	            			if (found_required_item == false) {
	            				found_required_items = false;
	            			} 
	            		})
	            		if (found_required_items == true) {
	            			var new_combo_item = combo.add_to_order_without_calculate();
	            			var new_combo_instance = new combo_instance(new_combo_item, required_order_items)
	            		}
	            	});
	            }
	        });
	    }
	    
	    
	    self.add_tender = function(tender_amount) {
	    	self.tender += tender_amount;
	    	self.calculate();
	    }
	    
	   	self.clear_tender = function() {
	    	self.tender = 0;
	    	self.calculate();
	    }
	};


	function combo_instance(combo_item, order_items) {
	
		var self = this;
		self.combo_item = combo_item;
		self.order_items = order_items;
		
		self.combo_item.combo_instances.push(self);
		angular.forEach(self.order_items, function(order_item) {
			order_item.part_of_combo_instances.push(self);
		});
	            			
		self.remove = function() {
			var removeIndex = -1;
			self.remove_order_items();
			removeIndex = self.combo_item.combo_instances.indexOf(self);
	        if (removeIndex !== -1) {
	            self.combo_item.combo_instances.splice(removeIndex, 1);
	        }
			self.combo_item.decrement_without_calculate();
		}
		
		self.remove_order_items = function() {
			angular.forEach(self.order_items, function(order_item) {
				removeIndex = order_item.part_of_combo_instances.indexOf(self);
	        	if (removeIndex !== -1) {
	            	order_item.part_of_combo_instances.splice(removeIndex, 1);
	        	}
			});	
		}
	};
	
	function order_item(product, order) {

	    var self = this;
	    self.product = product;
	    self.quantity = 1;
	    self.total = product.selling_price;
	    self.order = order;
	    self.part_of_combo_instances = [];
	    self.combo_instances = [];

	    self.remove_without_calculate = function() {
			var removeIndex = self.order.order_items.indexOf(self);
	        if (removeIndex !== -1) {
	            self.order.order_items.splice(removeIndex, 1);
	        }
	        angular.forEach(self.combo_instances, function(combo_instance) {
	        	combo_instance.remove();	
	        });
	        angular.forEach(self.part_of_combo_instances, function(part_of_combo_instance) {
				part_of_combo_instance.remove();
			});	
	    }
	    
	    self.remove = function() {
	    	//if (self.product.product_type_id != 3) {
				self.remove_without_calculate();
	        	self.order.calculate();
	    	//}
	    }


		self.decrement_without_calculate = function() {
		    self.quantity = self.quantity - 1;
	        if (self.part_of_combo_instances.length > self.quantity) {
	        	var last_part_of_combo_instance = self.part_of_combo_instances.pop();
	        	if (last_part_of_combo_instance != null) {
	        		last_part_of_combo_instance.remove();	
	        	}
	        }
			if (self.combo_instances.length > self.quantity) {
	        	var last_combo_instance = self.combo_instances.pop();
	        	if (last_combo_instance != null) {
	        		last_combo_instance.remove_order_items();	
	        	}
	        }
	        if (self.quantity <= 0) {
	            self.remove_without_calculate();
	        }
		}

	    self.decrement = function() {
			if (self.product.product_type_id != 3) {
				self.decrement_without_calculate();
	        	self.order.calculate();
	    	}
	    }

		self.increment_without_calculate = function() {
			self.quantity = self.quantity + 1;
		}
		
	    self.increment = function() {
	    	if (self.product.product_type_id != 3) {
	        	self.increment_without_calculate();
	        	self.order.calculate();
	    	}
	    }
	};
	</script>
</head>
<body ng-controller="ordersCtl">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Kontiki</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>


<div class="container">
        <div class="row">
            <div  id="content" >
            	<div class="product_groups">
            		<button ng-repeat="product_group in app.product_groups" ng-click=product_group.activate() class="product_group">
            		@{{ product_group.name }}
            		</button>
            	</div>
            	<button ng-repeat="product in app.active_product_group.products" class="product" ng-click=product.add_to_order()>@{{ product.name }}</button>
            </div>
            <div id="sidebar" >
            	<table class="order_items">
            		<tr><td>&nbsp</td><td class="action">&nbsp</td></tr>
            		<tr ng-repeat="order_item in app.order.order_items">
            			<td>@{{ order_item.quantity }} x @{{ order_item.product.name }}</td>
            			<td><button class="decrement change" ng-click=order_item.decrement()><i class="glyphicon glyphicon-minus"></i></button>
            				<button class="increment change" ng-click=order_item.increment()><i class="glyphicon glyphicon-plus"></i></button>
            				<button class="remove change" ng-click=order_item.remove()><i class="glyphicon glyphicon-remove"></i></button></td>
            		</tr>
            		<tr class="total"><td>Total</td><td>R @{{app.order.total}}</td></tr>
            		<tr class="tender"><td>Tender</td><td><input class="tender" ng-model="app.order.tender" type="number" placeholder="" ng-blur="app.order.calculate()"/></td></tr>
            		<tr class="change"><td>Change</td><td>@{{app.order.change}}</td></tr>
            	</table>
            	
            	<button class="tenderamount" ng-click=app.order.add_tender(100)>100</button>
            	<button class="tenderamount" ng-click=app.order.add_tender(50)>50</button>
            	<button class="tenderamount" ng-click=app.order.add_tender(20)>20</button>
            	<button class="tenderamount" ng-click=app.order.add_tender(10)>10</button>
            	<button class="tenderamount" ng-click=app.order.add_tender(5)>5</button>
            	<button class="tenderamount" ng-click=app.order.add_tender(2)>2</button>
            	<button class="tenderamount" ng-click=app.order.add_tender(1)>1</button>
            	<button class="tenderamount" ng-click=app.order.clear_tender()>Zero</button>
            	
            </div>
        </div>
        <button class="checkout" ng-click="app.order.checkout()">Check Out</button>
</div>

<div class="modal fade" id="confirmed_order_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Order Confirmed</h4>
      </div>
      <div class="modal-body">
        <h2>Order Number: @{{app.confirmed_order.ref}}</h2>
        <div ng-repeat="item in app.confirmed_order.items" >
        	<div>@{{item}}</div>
        </div>
        <h3>Total: R @{{app.confirmed_order.total}}</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">You broke it, well done</h4>
      </div>
      <div class="modal-body">
        <h5>Not even Chuck Norris could do it, well done!</h5>
        <h3>@{{app.error_status}}</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	
</body>
</html>