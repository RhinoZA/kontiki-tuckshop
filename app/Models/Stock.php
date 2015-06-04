<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    
	public $table = "stocks";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "product_id",
		"quantity"
	];

	public static $rules = [
	    
	];

}
