<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	protected $table = "orders";
	
	public function items()
	{
	    return $this->hasMany('App\OrderItem');
	}
	
	public function shift()
	{
	    return $this->belongsTo('App\Shift');
	}

}
