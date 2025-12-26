<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\HtmlString;

class category_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data_category = Category::get();
        $search = request()->get('keyword');
        $data_category = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })->get();
        return view('pages.category.category', compact('data_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.category.category_create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:categories|string|max:255',
            'description' => 'nullable|string',
        ],[
            'name.required' => 'Category wajib di isi.',  
            'name.unique' => 'Category sudah ada sebelumnya.',                              
            'name.string' => 'Category harus berupa string.',
            'name.max' => 'Category maksimal 255 karakter.',        
        ]);     

        Category::create($request->all());
        $message = new HtmlString("Category <b>{$request->name}</b> created successfully.");
        return redirect()->route('category.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data_category = Category::findOrFail($id);
        return view('pages.category.category_edit', compact('data_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'description' => 'nullable|string',
        ],[
            'name.required' => 'Category wajib di isi.',                              
            'name.string' => 'Category harus berupa string.',
            'name.max' => 'Category maksimal 255 karakter.',        
        ]);
        $data_category = Category::findOrFail($id);
        $data_category->update($request->all());
        $message = new HtmlString("Category <b>{$request->name}</b> updated successfully.");    
        return redirect()->route('category.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data_category = Category::findOrFail($id);
        $data_category->delete();
        $message = new HtmlString("Category <b>{$data_category->name}</b> deleted successfully.");

        return redirect()->route('category.index')->with('success', $message);  
    }
}
