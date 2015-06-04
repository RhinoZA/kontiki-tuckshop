@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
			    
			    <div class="panel-heading">User Roles</div>

				    <table class="table table-condensed table-hover table-bordered">
				        <tr>
				            <th>#</th>
				            <th>Name</th>
				            <th>Description</th>
				            <th>Action</th>
				        </tr>
				        
				        @foreach ($user_roles as $role)
					        <tr>
					            <td> {{ $role->id }} </td>
					            <td> {{ $role->display_name }} </td>
					            <td> {{ $role->description }} </td>
					            <td> <a href="{!! route('removeRoleFromUser', [ 'user' => $user->id, 'role' => $role->id ])!!}">Delete Role</a></td>
					        </tr>
					    @endforeach
				        
				    </table>
				</div>
			    
				<div class="panel-heading">Available Roles</div>

				    <table class="table table-condensed table-hover table-bordered">
				        <tr>
				            <th>#</th>
				            <th>Name</th>
				            <th>Description</th>
				            <th>Action</th>
				        </tr>
				        
				        @foreach ($available_roles as $role)
					        <tr>
					            <td> {{ $role->id }} </td>
					            <td> {{ $role->display_name }} </td>
					            <td> {{ $role->description }} </td>
					            <td> <a href="{!! route('addRoleToUser', [ 'user' => $user->id, 'role' => $role->id ])!!}">Add Role To User</a></td>
					        </tr>
					    @endforeach
				        
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
