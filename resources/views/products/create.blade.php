@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create Product</div>
				<div class="panel-body">
                    
                    @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/products') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name">
							</div>
						</div>
							
						<div class="form-group">
							<label class="col-md-4 control-label">Cost Price</label>
							<div class="col-md-6">
								<input type="decimal" class="form-control" name="cost_price">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Selling Price</label>
							<div class="col-md-6">
								<input type="decimal" class="form-control" name="selling_price">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Product Type</label>
							<div class="col-md-6">
								{!! Form::select('product_type_id', array('default' => 'Please select Product Type') + \App\ProductType::lists('name', 'id')) !!}
							</div>
						</div>

						<div id="product-kitchen"></div>
				
						<div class="form-group">
							<label class="col-md-4 control-label">Product Group</label>
							<div class="col-md-6">
								{!! Form::select('product_group_id', \App\ProductGroup::lists('name', 'id')) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Combo Group</label>
							<div class="col-md-6">
								{!! Form::select('combo_group_id', \App\ComboType::lists('name', 'id')) !!}
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Create New</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

    $('select').change(function() {
    	var id = $(this).prop('name');
    	if (id == 'product_type_id') {
    		$.ajax({
		        url: '/product_kitchens',
		        method: 'POST',
		        data: {
		          	selected: $(this).val()
		        },
		        success: function(data) {
		        	console.log(data);
		           	$('#product-kitchen').html(data);
		        }
		    });	
    	}
	});

</script>


@endsection
