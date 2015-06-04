<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {

	protected $table = 'ingredients';
	
	public function prepared_product() 
	{
	    return $this->belongsTo('App\Product', 'prepared_product_id');
	}
    
    public function ingredient_product() 
	{
	    return $this->belongsTo('App\Product', 'ingredient_product_id');
	}
    
}
