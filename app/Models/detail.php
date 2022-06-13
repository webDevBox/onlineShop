<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail extends Model
{
    use HasFactory;
    protected $table= 'details';
    protected $hidden = [
        'created_at', 'updated_at',
     ];

     protected $with = [
         'user', 'product'
     ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
     
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
}
