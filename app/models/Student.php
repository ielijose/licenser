<?php

class Student extends Model {

    protected $table = 'students';
    public $timestamp = true;

    protected $fillable = ['name', 'ci', 'section', 'gender', 'phone', 'email', 'address'];

	protected static $rules = [
        'name' => 'required',
		'ci' => 'required',
        'section' => 'required',
        'gender' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'address' => 'required',        
    ];

   
     
    /* Scopes */       
    
    /* Relationships */    
    public function prestamos(){
        return $this->hasMany('Prestamo', 'student_id', 'id');
    }
    /* Function */

    
}