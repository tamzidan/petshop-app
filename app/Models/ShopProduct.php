<?php

// app/Models/ShopProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'price',
        'stock_status',
        'link_tokopedia',
        'link_shopee',
        'link_whatsapp',
    ];
}