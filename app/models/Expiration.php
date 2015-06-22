<?php
use Carbon\Carbon;

class Expiration extends Model {

    protected $table = 'expirations';
    public $timestamp = true;

    protected $fillable = ['email', 'token', 'expiration'];

    protected static $rules = [
        'email' => 'required'
    ];

    /* BOOT */

    public static function boot()
    {
        parent::boot();

        static::creating(function($expiration){

            do{
                $token = sha1(uniqid().time());
                $count = Expiration::where('token', $token)->count();
            }while($count != 0);
            $expiration->token = $token;

            $minutes = (intval(Setting::key('link_duration')->first()->value) > 0) ? intval(Setting::key('link_duration')->first()->value) : 60;
            $expiration->expiration = Carbon::now()->addMinutes($minutes);
        });
    }

    /* Scopes */

    /* Relationships */

    /* Function */

}