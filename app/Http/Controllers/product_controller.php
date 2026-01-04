<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use App\Models\Category;
use Illuminate\Support\Str;

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
        $data_category = Category::get();
        return view('pages.product.product-create', compact('data_category'));
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
            'stock' => 'required|integer|min:1|max:10000',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5120',        ],
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
            'image.mimes' => 'Gambar hanya boleh dengan format jpg, png, jpeg',
            'image.image' => 'file harus berupa gambar',
        ]);

        $nama_file = Str::random(5).'.'.$request->image->extension();
        $file = $request->image->move(public_path('image_product'), $nama_file);

        // dd($file->getFileName());

        $last_code_product = Product::orderBy('code_product','desc')->first();
        $code_product = $this->logic_for_code_product($last_code_product);

        $data = $request->except('image');
        $data['image'] = $file->getFileName();
        $data['code_product'] = $code_product;
        
        $product = Product::create($data);
        $message = new HtmlString("Product <b>{$product->name}</b> created successfully.");

        return redirect()->route('product')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        $detail_product = $product;
        // dd($product);
        // $detail_product = Product::findOrFail($id);
        // dd($detail_product);
        return view('pages.product.product-show', compact('detail_product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $detail_product = $product;
        $data_category = Category::get();
        return view('pages.product.product-edit', compact('detail_product', 'data_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        // dd($request->image);
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

        $filename = $product->image;

        if($request->image){
            
            $old_image_path = public_path('/image_product/'. $filename);
            
            if(is_file($old_image_path)){
                unlink($old_image_path);
            }
            
            $file_obj = $request->file('image'); // Ini akan memastikan kita mengambil Objek File
            $nama_file = Str::random(5) . '.' . $file_obj->getClientOriginalExtension();
            // $nama_file = Str::random(5).'.'.$request->image->extension();
            $file = $request->image->move(public_path('image_product'), $nama_file);
            $filename = $file->getFileName();
        }

        $update_data = Product::where('code_product', $product->code_product)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $filename,
                'description' => $request->description,
            ]);
        
        $message = new HtmlString("Product <b>{$product->name}</b> updated successfully.");
        return redirect()->route('product')->with('success', $message);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $message = new HtmlString("Product <b>{$product->name}</b> deleted successfully.");
        return redirect()->route('product')->with('success', $message);
        
    }

    private function logic_for_code_product($last_code_product){

        if(!$last_code_product){
            $new_code = 'AA01';
        }else{
            $last_code = $last_code_product->code_product;
            $huruf = substr($last_code,0,2);
            $angka = (int) substr($last_code,2,2);
            
            // tambah angkanya
            $angka++;
            if($angka > 99){
                $angka = 1;
                $huruf++;
            }

            // TAHAP 4: Gabung lagi dan pastikan angka ada nol di depan (01, 02)
            $new_code = $huruf . str_pad($angka, 2, '0', STR_PAD_LEFT);
            
        }

        return $new_code;
    }
}
