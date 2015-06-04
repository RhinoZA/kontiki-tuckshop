<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model {

	protected $table = 'shifts';
	
	public function user()
	{
	    return $this->belongsTo('App\User');
	}
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
}
