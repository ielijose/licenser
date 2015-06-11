<?php

class License extends Model {

    protected $table = 'licenses';
    public $timestamp = true;

    protected $fillable = ['name', 'license', 'domain', 'status', 'user_id'];

	protected static $rules = [
        'name' => 'required',
		'license' => 'required',
    ];

    /* Scopes */

    public function scopeAvailables($query)
    {
        return $query->where('status', 'available');
    }

    /* Relationships */

    /* Function */

    public function getStatus()
    {
        switch ($this->status) {
            case 'available':
                return '<span class="label label-info"> Disponible </span>';
                break;

            case 'used':
                return '<span class="label label-success"> Usada </span>';
                break;

            default:
                # code...
                break;
        }
    }

}