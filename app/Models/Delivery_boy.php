<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery_boy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='delivery_boy';
    protected $fillable = [
        'user_id',
        'address_id',
        'bike_no',
        'licence_no',
        'licence_front_img',
        'licence_back_img',
        
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
   
    public $incrementing = true;

     /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function address()
    {
        return $this->hasOne('App\Models\User' ,'id');
    }


}
