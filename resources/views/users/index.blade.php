@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Users</div>
					<table class="table table-condensed table-hover table-bordered">
				        <tr>
				            <th>#</th>
				            <th>Username</th>
				            <th>Email</th>
				            <th>Action</th>
				        </tr>
				        
				        @foreach ($users as $user)
					        <tr>
					            <td> {{ $user->id }} </td>
					            <td> {{ $user->name }} </td>
					            <td> {{ $user->email }}</td>
					            <td> <a href="{{ action("UserController@edit",  [ 'user' => $user->id  ] ) }}">Edit</a> </td>
					        </tr>
					    @endforeach
				        
				    </table>
			</div>
		</div>
	</div>
</div>
@endsection
