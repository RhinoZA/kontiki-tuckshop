<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$product_groups = \App\ProductGroup::all()->load('products');
		$combo_rules = \App\ComboRule::all();
		return view('orders.create', [ 'products' => $product_groups, 'combo_rules' => $combo_rules ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$request_order_items = Request::all();
		$order_items = [];
		
		$total = 0;
		
		$order = new \App\Order;
		$order->total = 0;
		$order->cashier_id = \Auth::user()->id;
		
		$order->save();
		$ref = $order->id;
		
		foreach ($request_order_items as $request_order_item) {
			
			$order_item = new \App\OrderItem;
			$order_item->quantity = $request_order_item["quantity"];
			$order_item->order_id = $ref;
			$product = \App\Product::find($request_order_item["product_id"]);
			$total = $total + ($order_item->quantity * $product->selling_price);
			
			if (isset($product->kitchen_id)) // It is a prepared product
			{
				$order_item->kitchen_id = $product->kitchen_id;
			}
			
			$order_item->product_id = $request_order_item["product_id"];
			$order_item->is_completed = false;
			
			$order_item->save();
			$order_item_name = \App\Product::find($request_order_item["product_id"])->name;
			
			$order_items[] = $order_item->quantity . " x " . $order_item_name;
		}
		
		$order->total = $total;
		$order->save();
		
		return ["items" => $order_items, "ref" => $ref, "total" => $total];
		
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
		//
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
