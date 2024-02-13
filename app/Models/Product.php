<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $guarded = ["id"];
    protected $primaryKey = "id";
    protected $table = "products";
    protected $fillable = [
        "product_name",
        "category_id",
        "product_price",
        "product_quantity",
        "product_image",
    ];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    use HasFactory;
}