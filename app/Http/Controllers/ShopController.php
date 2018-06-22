<?php

namespace App\Http\Controllers;

use App\Helper\Cart;
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
	 * @param Cart $cart
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function cart(Cart $cart)
	{
		return view('shop.cart.show', [
			'cart' => $cart
		]);
	}

	/**
	 * Store item into cart.
	 *
	 * @param Request $request
	 * @param ShopItem $item
	 * @param Cart $cart
	 * @return Response
	 */
	public function cartStore(Request $request, ShopItem $item, Cart $cart)
	{
		$item->quantity = 1;
		if ($request->input('quantity') > 1) {
			$item->quantity = $request->input('quantity');
		}

		$cart->addItem($item);

		return redirect()->route('shop.cart');
	}

	/**
	 * Destroy item from cart.
	 *
	 * @param Request $request
	 * @param ShopItem $item
	 * @param Cart $cart
	 * @return Response
	 */
	public function cartUpdate(Request $request, ShopItem $item, Cart $cart)
	{
		$cart->updateQuantity($item, $request->input('direction'));

		return redirect()->route('shop.cart');
	}

	/**
	 * Destroy item from cart.
	 *
	 * @param ShopItem $item
	 * @param Cart $cart
	 * @return Response
	 */
	public function cartDestroy(ShopItem $item, Cart $cart)
	{
		$cart->removeItem($item);

		return redirect()->route('shop.cart');
	}
}
