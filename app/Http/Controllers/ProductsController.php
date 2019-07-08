<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Validator;
use Storage;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            throw new Exception(implode("\n",$validator->messages()->all()));
        }

        $product = new Product();
        $product->fill([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'quantity' => $request->get('quantity'),
            'created_at' => Carbon::now()
        ]);

        try {
            $data = [];

            if (Storage::exists('data.json')) {
                $data = json_decode(Storage::get('data.json'));
            }
            $data[] = $product->toArray();
            Storage::disk('local')->put('data.json', json_encode($data));
            return response()->json('saved successfully');
        } catch( Exception $e) {
            throw new $e;
        }
    }
}
