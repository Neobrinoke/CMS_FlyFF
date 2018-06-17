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
			return redirect()->route('shop.show', [$shop, $shop->slug]);
		}

		$categories = ShopCategory::all();
		$itemQuery = $shop->items();
		$canNotFind = false;

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

		if ($request->input('sale_type')) {
			$itemQuery->where('sale_type', $request->input('sale_type'));
		}

		$items = $itemQuery->paginate(15);

		if ($items->isEmpty()) {
			$canNotFind = true;
			$items = $shop->items()->paginate(15);
		}

		return view('shop.show', [
			'shop' => $shop,
			'items' => $items,
			'categories' => $categories,
			'canNotFind' => $canNotFind
		]);
	}

	/**
	 * Show detail of item.
	 *
	 * @param Shop $shop
	 * @param ShopItem $item
	 * @param string $slug
	 * @return Response
	 */
	public function item(Shop $shop, ShopItem $item, string $slug)
	{
		if ($slug !== $item->slug) {
			return redirect()->route('shop.item', [$item, $item->slug]);
		}

		return view('shop.item.show', [
			'shop' => $shop,
			'item' => $item
		]);
	}

	/**
	 * Return view for cart.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function cart()
	{
		$items = session('cart.items') ?? [];

		return view('shop.cart.show', [
			'items' => $items
		]);
	}

	/**
	 * Store item into cart.
	 *
	 * @param Request $request
	 * @param ShopItem $item
	 * @return Response
	 */
	public function cartStore(Request $request, ShopItem $item)
	{
		$items = session('cart.items', []);

		$item->qte = 1;
		if ($request->input('qte') > 1) {
			$item->qte = $request->input('qte');
		}

		if (isset($items[$item->id])) {
			$items[$item->id]->qte += $item->qte;
		} else {
			$items[$item->id] = $item;
		}

		session(['cart.items' => $items]);

		return redirect()->route('shop.cart');
	}

	/**
	 * Destroy item from cart.
	 *
	 * @param ShopItem $item
	 * @return Response
	 */
	public function cartDestroy(ShopItem $item)
	{
		$items = session('cart.items', []);

		if (isset($items[$item->id])) {
			unset($items[$item->id]);
		}

		session(['cart.items' => $items]);

		return redirect()->route('shop.cart');
	}
}
