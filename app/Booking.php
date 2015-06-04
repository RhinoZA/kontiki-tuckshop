<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

	protected $table = "bookings";
	
	public function order()
	{
	    return $this->belongsTo('App\Order');
	}

}
