<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

	protected $table = "order_items";
	
	public function product()
	{
	    return $this->belongsTo('App\Product');
	}
	
	public function type()
	{
	    return $this->belongsTo('App\OrderItemType');
	}

}
