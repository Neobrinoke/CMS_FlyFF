<?php

namespace App\Http\Controllers\Admin;

use App\Model\Web\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopController extends AdminController
{
    /**
     * Show all shops.
     *
     * @return Response
     */
    public function index()
    {
        $shops = Shop::query()->paginate(10);

        return view('admin.shop.index', [
            'shops' => $shops
        ]);
    }

    /**
     * Return create view.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.shop.create');
    }

    /**
     * Store new shop in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|max:50',
            'image_thumbnail' => 'image'
        ]);

        if ($request->file('image_thumbnail')) {
            $file = $request->file('image_thumbnail')->store('shop/thumbnails', [
                'disk' => 'public'
            ]);

            $validatedData['image_thumbnail'] = '/uploads/' . $file;
        }

        $validatedData['is_active'] = $request->input('is_active') ? true : false;

        Shop::query()->create($validatedData);

        $request->session()->flash('success', trans('admin/shop.create.form.messages.success'));

        return redirect()->route('admin.shop.index');
    }

    /**
     * Show specific shop.
     *
     * @param Shop $shop
     * @return Response
     */
    public function show(Shop $shop)
    {
        $items = $shop->items()->paginate(10);

        return view('admin.shop.show', [
            'shop' => $shop,
            'items' => $items
        ]);
    }
}
