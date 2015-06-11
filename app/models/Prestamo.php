<?php
use Carbon\Carbon;

class Prestamo extends Model {

    protected $table = 'prestamos';
    public $timestamp = true;

    protected $fillable = ['student_id', 'book_id', 'status'];


	protected static $rules = [
        'student_id' => 'required',
		'book_id' => 'required',
    ];
  
    /* Scopes */   
    
    /* Relationships */ 

    public function book(){
    	return $this->BelongsTo('Book');
    }

    public function student(){
    	return $this->BelongsTo('Student');
    }

    /* Function */    

    public function getHumanDate($column = 'created_at')
    {
        $txt = 'carbon.timediff.';
        $isNow = true;
        $other = Carbon::now();
        $delta = abs($other->diffInSeconds($this->$column));

        $divs = array(
           'second' => Carbon::SECONDS_PER_MINUTE,
           'minute' => Carbon::MINUTES_PER_HOUR,
           'hour'   => Carbon::HOURS_PER_DAY,
           'day'    => 30,
           'month'  => Carbon::MONTHS_PER_YEAR
           );

        $unit = 'year';
        foreach ($divs as $divUnit => $divValue) {
            if ($delta < $divValue) {
                $unit = $divUnit;
                break;
            }

            $delta = floor($delta / $divValue);
        }

        if ($delta == 0) {
            $delta = 1;
        }

        $txt .= $unit;
        return Lang::choice($txt, $delta, compact('delta'));
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'on':
                return '<span class="label label-warning"> Prestado </span>';
                break;

            case 'off':
                return '<span class="label label-success"> Devuelto </span>';
                break;
            
            default:
                # code...
                break;
        }
    }

    public function devolver()
    {
        $this->status = 'off';
        $this->book->devolver();
        $this->touch();
        return $this->save();
    }
}