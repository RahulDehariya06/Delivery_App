<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table='banner';
    
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

    public function shop(){

        return $this->hasOne('App\Models\Stores' ,'id');
    }

}
