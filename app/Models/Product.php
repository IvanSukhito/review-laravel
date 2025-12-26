<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    //
     //fillable lagi
    protected   $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'image',
        'code_product',
        'category_id',
    ];
    protected $primaryKey = 'id';
    // protected primarykey kalau nama primary keynya bukan id
    protected $guarded = [
        'id',
        // inisialisasi guarded artinya field yang tidak boleh diisi massal
    ];

    // relasti one to many
    // public function category(): BelongsTo
    // {
    //     // Laravel akan mencari 'category_id' di tabel products secara otomatis
    //     return $this->belongsTo(Category::class);
    // }

    public function category(): BelongsTo
    {
        // mesin akan mencari category_id di table/model products scara auto
        return $this->belongsTo(Category::class);
    }

}
