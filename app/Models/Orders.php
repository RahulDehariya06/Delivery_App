<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='order';
    protected $fillable = [
        'id',
        'user_id',
        'store_id',
        'address_id',
        'total_price',
        
    ];

     /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        return $this->hasOne('App\Models\Orders' ,'id');
       
    }
}
