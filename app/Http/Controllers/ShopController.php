<?php

namespace App\Http\Controllers;

use App\Model\Web\Shop;
use App\Model\Web\ShopCategory;
use App\Model\Web\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopController extends Controller
{
	/**
	 * Show all shops.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shops = Shop::all();

		return view('shop.index', [
			'shops' => $shops
		]);
	}

	/**
	 * Show items shop.
	 *
	 * @param Request $request
	 * @param Shop $shop
	 * @param string $slug
	 * @return Response
	 */
	public function show(Request $request, Shop $shop, string $slug)
	{
		if ($slug !== $shop->slug) {
			return redirect()->route('shop.show', [
				'shop' => $shop,
				'slug' => $shop->slug
			]);
		}

		$categories = ShopCategory::all();

		$itemQuery = $shop->items();

		if ($request->input('title')) {
			$itemQuery->where('title', 'like', '%' . $request->input('title') . '%');
		}

		if ($request->input('price_start') && $request->input('price_end')) {
			$itemQuery->whereBetween('price', [
				$request->input('price_start'),
				$request->input('price_end')
			]);
		} else if ($request->input('price_start')) {
			$itemQuery->where('price', $request->input('price_start'));
		}

		if ($request->input('category_id')) {
			$itemQuery->whereIn('category_id', $request->input('category_id'));
		}

		if ($request->input('sort_by')) {
			[$column, $direction] = explode('-', $request->input('sort_by'));
			$itemQuery->orderBy($column, $direction);
		}

		//@todo implement research with $request

		$items = $itemQuery->paginate(15);

		if ($items->isEmpty()) {
			$items = $shop->items()->paginate(15);
		}

		return view('shop.show', [
			'shop' => $shop,
			'categories' => $categories,
			'items' => $items
		]);
	}
}
