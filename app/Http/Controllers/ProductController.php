<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $sortKey = $request->input("sortKey");
        $sortOrder = $request->input("sortOrder");

        // $query = $request->input("query");
        // surely query will be set
        // $products = Product::latest('updated_at');

        // if (isset($query)) {
        //     $products = $products->where('name', 'like', "%$query%");
        // }

        // if sorting applied then orderBy name
        // otherwise sort by latest
        if (isset($sortKey)) {
            $products = Product::orderBy($sortKey, $sortOrder);
        } else {
            $products = Product::latest('updated_at');
        }
        $products = $products->paginate(5);

        // append extra query params in case of pagination, query and sorting
        $pagination_ = array();
        $data = array();
        $data['products'] = $products;
        if (isset($sortKey)) {
            $pagination_['sortKey'] = $sortKey;
            $pagination_['sortOrder'] = $sortOrder;
            $data['sortOrder'] = $sortOrder;
            $data['sortKey'] = $sortKey;
        }
        if (isset($query)) {
            $pagination_['query'] = $query;
            $data['query'] = $query;
        }
        if (!empty($pagination_)) {
            $pagination = $products->appends($pagination_);
        }
        return view('products.index')->with($data);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:10000'
        ]);

        // upload image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product = new Product();
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        // to redirect the user back and include a success message:
        return Redirect::route('products.index')->withSuccess('New Product Created!!');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif|max:10000'
        ]);

        $product = Product::where('id', $id)->first();

        if (isset($request->image)) {
            // upload image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        return Redirect::route('products.index')->withSuccess('Product Updated!!');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();

        return Redirect::route('products.index')->withSuccess('Product deleted !!');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.show', ['product' => $product]);
    }
}