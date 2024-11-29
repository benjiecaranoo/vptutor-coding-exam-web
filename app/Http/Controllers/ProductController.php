<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, #[CurrentUser] User $user)
    {
        $query = Product::with('user');

        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $user->is_admin ? $query->get() : $query->where('user_id', $user->id)->get();
        $view = $user->is_admin ? 'admin.products.index' : 'products.index';

        return view($view, compact('products'));
    }

    public function store(StoreProductRequest $request, #[CurrentUser] User $user)
    {
        $product = Product::create($request->validated());

        $view = $user->is_admin ? 'admin.products.index' : 'products.index';

        return redirect()->route($view)->with('success', 'Product created successfully');
    }

    public function edit(Product $product, #[CurrentUser] User $user)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product, #[CurrentUser] User $user)
    {
        $product->update($request->validated());
        $view = $user->is_admin ? 'admin.products.index' : 'products.index';

        return redirect()->route($view)->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product, #[CurrentUser] User $user)
    {
        $product->del_flag = true;
        $product->save();
        $view = $user->is_admin ? 'admin.products.index' : 'products.index';

        return redirect()->route($view)->with('success', 'Product deleted successfully');
    }
}
