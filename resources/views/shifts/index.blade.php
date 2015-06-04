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
				        </tr>
				        
				        @foreach ($shifts as $shift)
					        <tr>
					            <td> {{ $shift->id }} </td>
					            <td> {{ $shift->user()->first()->name }} </td>
					            <td> {{ $shift->start_time }} </td>
					            <td> {{ $shift->end_time }}</td>
					        </tr>
					    @endforeach
				        
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
