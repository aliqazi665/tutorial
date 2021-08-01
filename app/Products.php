<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use Notifiable;
    protected $fillable = [
        'productname', 'productdescription', 'productquality','productprice','productimage'
    ];  
}
