<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password_resets';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';
    protected $primaryKey = 'token';
    public $incrementing = false;
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at','updated_at'];
    
    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];
    
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
    }
    
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function routeNotificationForNexmo()
    {
        return phoneFormatInt($this->phone, config('country.code'));
    }

    public function routeNotificationForTwilio()
    {
        $phone = phoneFormatInt($this->phone, config('country.code'));
        if (!Str::startsWith($phone, '+')) {
            $phone = '+' . $phone;
        }
        return $phone;
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}



