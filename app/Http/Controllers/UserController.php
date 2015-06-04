<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('users.index', [ "users" => \App\User::all() ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (\Auth::user()->hasRole('admin'))
		{
			$data = [];
			
			$user = \App\User::find($id);
			if ($user == null)
				return redirect('users/'.$id.'/edit');
			$user_roles = $user->roles()->get();
			$global_roles = \App\Role::all();
			$available_roles = $global_roles->except($user_roles->modelKeys());
			
			$data["user"] = $user;
			$data["user_roles"] = $user_roles;
			$data["available_roles"] = $available_roles;
			
				
			return view('users.edit', $data);	
		}
		
		return view('users.index');
	}
	
	public function addRoleToUser($user, $role)
	{
		$data = [];
			
		$user = \App\User::find($user);
		$user_roles = $user->roles()->get();
		$global_roles = \App\Role::all();
		$available_roles = $global_roles->except($user_roles->modelKeys());

	    $user->attachRole($role);
	
		$data["user"] = $user;
		$data["user_roles"] = $user_roles;
		$data["available_roles"] = $available_roles;
			
				
		return redirect('users/' . $user->id . '/edit');
	}
	
	public function removeRoleFromUser($user, $role)
	{
		$data = [];
		
		$user = \App\User::find($user);
		$user_roles = $user->roles()->get();
		
		$role_to_delete = \App\Role::find($role)->first()->id;
		
		$user_roles->destroygm($role_to_delete);
		
		$global_roles = \App\Role::all();
		$available_roles = $global_roles->except($user_roles->modelKeys());
		
		$data["user"] = $user;
		$data["user_roles"] = $user_roles;
		$data["available_roles"] = $available_roles;
			
				
		return redirect('users/' . $user->id . '/edit');
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
