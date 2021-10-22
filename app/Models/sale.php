<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $table = 'sale_table';
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        "Product_Id",
        "sale_quantity",
        "selling_price",
        "Profit"
    ];
}
