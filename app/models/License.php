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

    public function scopeAvailable($query, $license)
    {
        return $query->where('status', 'available')->where('license', $license);
    }

    /* Relationships */

    /* Function */

    public function getStatus()
    {
        switch ($this->status) {
            case 'available':
                return '<span class="label label-info"> Disponible </span>';
                break;

            case 'actived':
                return '<span class="label label-success"> Activada </span>';
                break;

            default:
                # code...
                break;
        }
    }

    public function activate($domain){
        $this->domain = $domain;
        $this->status = 'actived';
        return $this->save();
    }

}