<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class PublicProductController extends Controller
{
    //
  public function paginate(Request $request)
  {
    return Product::with('Category')->paginate($request->per_page);
  }


  public function index()
  {
    $products = Product::all();

    foreach($products as $product)
    {
      $product->category_name = $product->category->category_name;
    }

    return response()->json($products);
  }



  public function show($id)
  {
    return Product::with(['Category', 'ProductDetail'])->find($id);
  }


  public function productsByCategory(Request $request)
  {
    return Product::with('Category')->where('category_id', $request->category_id)->get();
  }


  /**
   * Get products sorted by order
   *
   */
  public function productsSortByOrder(Request $request)
  {
    return Product::with('Category')->orderBy($request->key, $request->type)->get();
  }

}
