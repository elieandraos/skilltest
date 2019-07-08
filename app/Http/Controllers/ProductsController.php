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
    protected $storageFile;

    public function __construct()
    {
        $this->storageFile = 'data.json';
    }

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

            if (Storage::exists($this->storageFile)) {
                $data = json_decode(Storage::get($this->storageFile));
            }
            $data[] = $product->toArray();
            Storage::disk('local')->put($this->storageFile, json_encode($data));
            return response()->json('saved successfully');
        } catch( Exception $e) {
            throw new $e;
        }
    }

    public function load()
    {
        if (!Storage::exists($this->storageFile)) {
            return response()->json([]);
        }

        $data = json_decode(Storage::get($this->storageFile));

        $products = [];
        $totalAllProducts = 0;
        foreach ($data as $item) {
            $product = new Product();
            $totalValue = $item->quantity * $item->price;

            $product->fill([
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'created_at' => $item->created_at,
                'total_value' => $totalValue,
            ]);

            $products[] = $product;
            $totalAllProducts += $totalValue;
        }
        return view('products.data', ['products' => $products, 'totalAllProducts' => $totalAllProducts]);
    }
}
