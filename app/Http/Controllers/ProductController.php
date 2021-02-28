<?php

namespace App\Http\Controllers;

use App\Events\SearchEvent;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function search(Request $request)
    {
        $query = $request->query('query');
        $products = Product::where('name', 'like', '%' . $query . '%')
            ->get();

        if ($products->count() > 0) {
            //broadcast search results with Pusher channels
            event(new SearchEvent($products));
            return response()->json($products);
        } else {
            return response()->json(null);
        }
    }

    //fetch all products
    public function get(Request $request)
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function delete($id)
    {
        $products = \App\Product::find($id);
        if(!empty($products)){
            $products->delete();
            $msg = [
                'success' => true,
                'message' => 'Order deleted successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'Order deleted failed!'
            ];
            return response()->json($msg);
        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'name' => 'required',
          'count' => 'required',
          'maxcount' => 'required'
        ]);

        $project = \App\Product::create([
          'name' => $validatedData['name'],
          'count' => $validatedData['count'],
          'maxcount' => $validatedData['maxcount'],
        ]);

        $msg = [
            'success' => true,
            'message' => 'Article created successfully!'
        ];

        return response()->json($msg);
    }
    public function plus(Request $request, $id)
    {
        $validatedData = $request->validate([
          'count' => 'required'
        ]);

        $article = \App\Product::find($id);
        $article->count = $validatedData['count'];
        $article->save();

        $msg = [
            'success' => true,
            'message' => 'Count updated successfully'
        ];

        return response()->json($msg);
    }
    public function minus(Request $request, $id)
    {
        $validatedData = $request->validate([
          'count' => 'required'
        ]);

        $article = \App\Product::find($id);
        $article->count = $validatedData['count'];
        $article->save();

        $msg = [
            'success' => true,
            'message' => 'Count updated successfully'
        ];

        return response()->json($msg);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'count' => 'required',
            'maxcount' => 'required'
        ]);

        $article = \App\Product::find($id);
        $article->name = $validatedData['name'];
        $article->count = $validatedData['count'];
        $article->maxcount = $validatedData['maxcount'];
        $article->save();

        $msg = [
            'success' => true,
            'message' => 'Count updated successfully'
        ];

        return response()->json($msg);
    }
}
