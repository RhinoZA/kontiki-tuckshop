<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table = "products";
	protected $fillable = array('name', 'cost_price', 'selling_price', 'combo_group_id', 'product_group_id', 'product_type_id');
	
	
	public function product_group()
	{
	    return $this->hasMany('App\ProductGroup');
	}
	
	public function kitchen()
	{
		return $this->belongsTo('App\Kitchen');
	}
	
	public function combo_rules()
	{
		return $this->hasMany('App\ComboRule');
	}

}
