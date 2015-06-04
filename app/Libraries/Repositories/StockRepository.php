<?php

namespace App\Libraries\Repositories;


use App\Models\Stock;

class StockRepository
{

	/**
	 * Returns all Stocks
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return Stock::all();
	}

	/**
	 * Stores Stock into database
	 *
	 * @param array $input
	 *
	 * @return Stock
	 */
	public function store($input)
	{
		return Stock::create($input);
	}

	/**
	 * Find Stock by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|Stock
	 */
	public function findStockById($id)
	{
		return Stock::find($id);
	}

	/**
	 * Updates Stock into database
	 *
	 * @param Stock $stock
	 * @param array $input
	 *
	 * @return Stock
	 */
	public function update($stock, $input)
	{
		$stock->fill($input);
		$stock->save();

		return $stock;
	}
}