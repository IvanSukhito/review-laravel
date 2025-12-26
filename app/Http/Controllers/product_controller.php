<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class product_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $data_product_a = [
        //     'products' => [
        //         [
        //             'id' => 1,
        //             'name' => 'Product A',
        //             'price' => 100000,
        //         ],
        //         [
        //             'id' => 2,
        //             'name' => 'Product B',
        //             'price' => 150000,
        //         ],
        //         [
        //             'id' => 3,
        //             'name' => 'Product C',
        //             'price' => 200000,
        //         ],
        //     ]
        // ];
        // $data_product_b = [
        //     'id' => 1,
        //     'name' => 'Product Balsem',
        //     'price' => 250000,

        // ];
        $data_toko = [
            'name' => 'Toko Sukhito',
            'address' => 'Jakarta, Indonesia',
            'tipe' => 'Toko Online',
        ];
        
        // $search = $request->query('search');
        $search = $request->query('keyword');
        // dd($request->keyword);

        //join manual
        // $data_product = Product::when($search, function ($query, $search) {
        //     return $query->where('name', 'like', "%{$search}%")
        //                  ->orWhere('description', 'like', "%{$search}%");
        // })
        // ->join('categories','categories.id','=','products.category_id')
        // ->select('products.*', 'categories.name AS category_name')
        // ->get();

        $data_product = Product::query()->with('category')->when($search, function ($query, $search){
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
        })->get();
        return view('pages.product.product', compact('data_toko', 'data_product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.product.product-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:1|max:1000',
            'description' => 'nullable|string',
        ],
        [
            'name.required' => 'Nama product wajib diisi.',
            'name.string' => 'Nama product harus berupa teks.',
            'name.max' => 'Nama product maksimal 255 karakter.',
            'price.required' => 'Harga product wajib diisi.',
            'price.numeric' => 'Harga product harus berupa angka.',
            'price.min' => 'Harga product minimal Rp. 1000.',
            'stock.required' => 'Stok product wajib diisi.',
            'stock.min' => 'Stok product minimal 1.',
            'stock.max' => 'Stok product maksimal 1000.',
        ]);
        Product::create($request->all());
        return redirect()->route('product')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, $id)
    {
        //
        // dd($id);
        $detail_product = Product::findOrFail($id);
        // dd($detail_product);
        return view('pages.product.product-show', compact('detail_product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        //
        $detail_product = Product::findOrFail($id);
        return view('pages.product.product-edit', compact('detail_product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:1|max:10000',
            'description' => 'nullable|string',
        ],
        [
            'name.required' => 'Nama product wajib diisi.',
            'name.string' => 'Nama product harus berupa teks.',
            'name.max' => 'Nama product maksimal 255 karakter.',
            'price.required' => 'Harga product wajib diisi.',
            'price.numeric' => 'Harga product harus berupa angka.',
            'price.min' => 'Harga product minimal Rp. 1000.',
            'stock.required' => 'Stok product wajib diisi.',
            'stock.min' => 'Stok product minimal 1.',
            'stock.max' => 'Stok product maksimal 1000.',
        ]);

        $update_data = Product::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);
        
        return redirect()->route('product')->with('success', 'Product updated successfully.');
        // dd('berhasil bos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        //
        // dd($id);
        $product = Product::findOrFail($id);
        $product->delete();
        $message = new HtmlString("Product <b>{$product->name}</b> deleted successfully.");
        return redirect()->route('product')->with('success', $message);
        
    }
}
