<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stores extends Model
{
    use SoftDeletes,HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table='stores';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
   
    public $incrementing = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id',
    	'store_name',
    	'started_at',
    	'parent_id',
    	'address_id',
    	'store_open_time',
    	'store_close_time',
    	'created_at',
    	'updated_at',

    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
    }

     /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function address()
    {
        return $this->hasOne('App\Models\Address' ,'store_id');
    }

     public function AllUsers()
    {
        return $this->hasMany('App\Models\Address');
    }
     public function AllStores()
    {
        return $this->hasMany('App\Models\Stores','id');
    }
    

    
    public function user()
    {
        return $this->hasOne('App\Models\User' ,'id');
       
    }
     public function pictures()
    {
        return $this->hasMany('App\Models\Picture' ,'id');
       
    }
    

    public function stores() 
    {
        return $this->hasMany('App\Models\Stores', 'id');
    }

	public function StoreCount(){
		return $this->hasMany(Stores::class, 'category_id');
	}
}
