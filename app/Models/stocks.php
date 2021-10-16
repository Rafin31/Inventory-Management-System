<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stocks extends Model
{
    protected $table = 'stocks';
    protected $dateFormat = 'U';
    use HasFactory;
    protected $fillable = [
        "Product_Name",
        "Catagory",
        "Seller_Name",
        "Product_Price",
        "Quantity",
        "Total_Price",
        "Stock-in_date"
    ];
}
