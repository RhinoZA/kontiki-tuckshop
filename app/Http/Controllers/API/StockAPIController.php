<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Libraries\Repositories\StockRepository;
use Response;

class StockAPIController extends AppBaseController
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
		$stocks = $this->stockRepository->all();

		return Response::json(ResponseManager::makeResult($stocks->toArray(), "Stocks retrieved successfully."));
	}

	/**
	 * Show the form for creating a new Stock.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created Stock in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Stock::$rules) > 0)
            $this->validateRequest($request, Stock::$rules);

        $input = $request->all();

		$stock = $this->stockRepository->store($input);

		return Response::json(ResponseManager::makeResult($stock->toArray(), "Stock saved successfully."));
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
			$this->throwRecordNotFoundException("Stock not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($stock->toArray(), "Stock retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified Stock.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified Stock in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$stock = $this->stockRepository->findStockById($id);

		if(empty($stock))
			$this->throwRecordNotFoundException("Stock not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$stock = $this->stockRepository->update($stock, $input);

		return Response::json(ResponseManager::makeResult($stock->toArray(), "Stock updated successfully."));
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
			$this->throwRecordNotFoundException("Stock not found", ERROR_CODE_RECORD_NOT_FOUND);

		$stock->delete();

		return Response::json(ResponseManager::makeResult($id, "Stock deleted successfully."));
	}

}
