<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		$this->call('ProductTypesTableSeeder');
		$this->command->info('ProductTypes table seeded!');
		
		$this->call('ComboTypesTableSeeder');
		$this->command->info('ComboTypes table seeded!');
		
		$this->call('ProductGroupsTableSeeder');
		$this->command->info('ProductGroups table seeded!');
		
		$this->call('RolesTableSeeder');
		$this->command->info('Roles table seeded!');
		
		$this->call('UserTableSeeder');
		$this->command->info('Users table seeded!');
		
	}

}

class UserTableSeeder extends Seeder {
	
	public function run()
	{
		$user = new \App\User;
		$user->email = 'rhino.kotze@gmail.com';
		$user->password = Hash::make('poiu');
		$user->name = 'Rijnhardt Kotze';
		$user->save();
		
		$user = App\User::where('email', '=', 'rhino.kotze@gmail.com')->firstOrFail();
		$roles = App\Role::all();
		
		foreach ($roles as $role)
		{
			$user->attachRole($role);
		}
	}
}


class RolesTableSeeder extends Seeder {
	
	public function run()
	{
		$cashier = new \App\Role;
		$cashier->name = 'cashier';
		$cashier->display_name = 'Cashier';
		$cashier->description = 'User is a cashier';
		$cashier->save();
		
		$cook = new \App\Role;
		$cook->name = 'cook';
		$cook->display_name = 'Cook';
		$cook->description = 'User is a cook';
		$cook->save();
		
		$admin = new \App\Role;
		$admin->name = 'admin';
		$admin->display_name = 'Administrator';
		$admin->description = 'User is an admin';
		$admin->save();
		
	}
}

class ProductTypesTableSeeder extends Seeder {
	
	public function up()
	{
		$prepared = new \App\ProductType;
		$prepared->name = 'Prepared';	
		$prepared->save();
		
		$dispensed = new \App\ProductType;
		$dispensed->name = 'Dispensed';	
		$dispensed->save();
		
		$combo = new \App\ProductType;
		$combo->name = 'Combo';	
		$combo->save();
	}
	
}

class ProductGroupsTableSeeder extends Seeder {
	
	public function up()
	{
		$meals = new \App\ProductGroup;
		$meals->name = 'Meals';	
		$meals->save();
		
		$drinks = new \App\ProductGroup;
		$drinks->name = 'Drinks';	
		$drinks->save();
		
		$sweets = new \App\ProductGroup;
		$sweets->name = 'Sweets';	
		$sweets->save();
		
		$chips = new \App\ProductGroup;
		$chips->name = 'Chips';	
		$chips->save();
	}
	
}

class ComboTypesTableSeeder extends Seeder {
	
	public function up()
	{
		$burger = new \App\ComboType;
		$burger->name = 'Burger';
		$burger->save();
		
		$hotdog = new \App\ComboType;
		$hotdog->name = 'Hotdog';
		$hotdog->save();
		
		$colddrink = new \App\ComboType;
		$colddrink->name = 'Cold drink';
		$colddrink->save();
		
		$energydrink = new \App\ComboType;
		$energydrink->name = 'Energy drink';
		$energydrink->save();
	}
	
}