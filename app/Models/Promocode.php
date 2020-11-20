<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promocode extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table='promocode';
    
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
    	'title',
    	'valid_from',
    	'expiration',
    	'usages_limit_per_coupen',
    	'limit_per_user',
    	'type',
    	'created_at',
    	'updated_at',

    ];
}
