<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = \App\Product::all();
		
		return view('products.index', ['products' => $products]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	
		$inputs = \Input::all();
		$product = new \App\Product;
			
		$product->name = $inputs['name'];
		$product->cost_price = $inputs['cost_price'];
		$product->selling_price = $inputs['selling_price'];
		$product->product_type_id = $inputs['product_type_id'];
  		$product->product_group_id = $inputs['product_group_id'];
  		$product->combo_type_id = $inputs['combo_group_id'];
  		
  		if (isset($inputs['kitchen_id']))
  		{
  			$product->kitchen_id = $inputs['kitchen_id'];
  		}
		
		$product->save();
		
	
		return redirect('products/create');
	

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the product
        $product = \App\Product::find($id);

        // show the edit form and pass the product
        return view('products.edit')
            ->with('product', $product);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = \App\Product::find($id);
		$product->update(\Input::all());
		
		$products = \App\Product::all();
		
		return view('products.index', array('products' => $products));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		dd('Destroyed!');
	}

}
