<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateStockRequest;
use App\Libraries\Repositories\StockRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class StockController extends AppBaseController
{

	/** @var  StockRepository */
	private $stockRepository;

	function __construct(StockRepository $stockRepo)
	{
		$this->stockRepository = $stockRepo;
	}

	/**
	 * Display a listing of the Stock.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$stocks = \App\Stock::all()->load('product');
		
		$stocks = \DB::select('select 
				products_sum.id, 
				products_sum.name, 
				sum(consumed) as total_consumed, 
				sum(purchased) as total_purchased, 
				sum(purchased - consumed) as remaining 
			from (
				select 
					products.id, 
					products.name, 
					0 as purchased, 
					ifnull(order_items.quantity, 0) as consumed,
					order_items.id as unique_id
				from products 
				inner join order_items on products.id = order_items.product_id
				where products.product_type_id = 2 or products.product_type_id = 4
			union 
				select 
					products.id, 
					products.name, 
					ifnull(stocks.quantity, 0) as purchased, 
					0 as consumed,
					stocks.id as unique_id
				from products 
				left join stocks on products.id = stocks.product_id
				where products.product_type_id = 2 or products.product_type_id = 4
			union 
				select 
					products.id, 
					products.name, 
					0 as purchased, 
					ifnull(ingredient_order_items.quantity * ingredients.quantity, 0) as consumed,
					ingredient_order_items.id as unique_id
				from products 
				inner join ingredients on products.id = ingredients.ingredient_product_id 
				inner join order_items as ingredient_order_items on ingredients.prepared_product_id = ingredient_order_items.product_id
				where products.product_type_id = 2 or products.product_type_id = 4
			) as products_sum 
			group by products_sum.id, products_sum.name
			');
		
		//The Query has been updated. I have been working on phpmyadmin. This one I just pasted is the one that is final
		
		return view('stocks.index')->with('stocks', $stocks);
	}

	/**
	 * Show the form for creating a new Stock.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stocks.create');
	}

	/**
	 * Store a newly created Stock in storage.
	 *
	 * @param CreateStockRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateStockRequest $request)
	{
        $input = $request->all();

		$stock = $this->stockRepository->store($input);

		Flash::message('Stock saved successfully.');

		return redirect(route('stocks.index'));
	}

	/**
	 * Display the specified Stock.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$stock = $this->stockRepository->findStockById($id);

		if(empty($stock))
		{
			Flash::error('Stock not found');
			return redirect(route('stocks.index'));
		}

		return view('stocks.show')->with('stock', $stock);
	}

	/**
	 * Show the form for editing the specified Stock.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stock = $this->stockRepository->findStockById($id);

		if(empty($stock))
		{
			Flash::error('Stock not found');
			return redirect(route('stocks.index'));
		}

		return view('stocks.edit')->with('stock', $stock);
	}

	/**
	 * Update the specified Stock in storage.
	 *
	 * @param  int    $id
	 * @param CreateStockRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateStockRequest $request)
	{
		$stock = $this->stockRepository->findStockById($id);

		if(empty($stock))
		{
			Flash::error('Stock not found');
			return redirect(route('stocks.index'));
		}

		$stock = $this->stockRepository->update($stock, $request->all());

		Flash::message('Stock updated successfully.');

		return redirect(route('stocks.index'));
	}

	/**
	 * Remove the specified Stock from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$stock = $this->stockRepository->findStockById($id);

		if(empty($stock))
		{
			Flash::error('Stock not found');
			return redirect(route('stocks.index'));
		}

		$stock->delete();

		Flash::message('Stock deleted successfully.');

		return redirect(route('stocks.index'));
	}

}
