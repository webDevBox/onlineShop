<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class detail extends Model
{
    use HasFactory;
    protected $table= 'details';
    protected $hidden = [
        'created_at', 'updated_at',
     ];

     public const Status = [
        'Pending'  => 0,
        'Paid' => 1
    ];

    public static function getStatusAttribute($status)
    {
        return array_search($status, self::Status);
    }  

     protected $with = [
         'user', 'product'
     ];

     protected $fillable= [
        'user_id', 'product_id', 'total', 'paid', 'status'
    ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }
     
     public function product()
     {
         return $this->belongsTo(Product::class);
     }

     public function getCreatedAtAttribute($created_at)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->diffForHumans();
    }
}
