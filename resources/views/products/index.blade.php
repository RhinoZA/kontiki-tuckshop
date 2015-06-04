@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<table class="table table-condensed table-hover table-bordered">
				        <tr>
				            <th>#</th>
				            <th>Name</th>
				            <th>Cost Price</th>
				            <th>Selling Price</th>
				            <th>Markup</th>
				            <th>Edit</th>
				            <th>Delete</th>
				        </tr>
				        
				        @foreach ($products as $product)
					        <tr>
					            <td> {{ $product->id }} </td>
					            <td> {{ $product->name }} </td>
					            <td> {{ $product->cost_price }}</td>
					            <td> {{ $product->selling_price }}</td>
					            <td> {{ round((($product->selling_price - $product->cost_price) / $product->cost_price) * 100) }} %</td>
					            <td> <a href="{{ action("ProductController@edit",  [ 'product' => $product->id  ] ) }}">Edit</a> </td>
					            
					        </tr>
					    @endforeach
				        
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
