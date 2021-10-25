<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;


class Cart extends Model
{
    use HasFactory;
    protected $table ='carts';
    protected $fillable =['productId','userId','quantity'];


    public function products()
    {   
        return $this->belongsTo(Product::class, 'productId', 'id');
    }

    public function users()
    {   
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
