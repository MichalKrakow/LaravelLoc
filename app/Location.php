<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Location extends Model
{
	protected $geofields = array('location');

    public function user()
    {
    	return $this->belongsTo("App\User");
    }

    public function setLocationAttribute($value) {
        // $value = str_replace(",", " ", $value);
        $this->attributes['location'] = DB::raw("POINT($value)");
    }
    
    public function newQuery($excludeDeleted = true)
    {
        $raw='';
        foreach($this->geofields as $column){
            $raw .= ' astext('.$column.') as '.$column.' ';
        }
 
        return parent::newQuery($excludeDeleted)->addSelect('*',DB::raw($raw));
    }
    
    public function getLocationAttribute($value){
 
        $loc =  substr($value, 6);
        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);
 
        return substr($loc,0,-1);
    }
    public function scopeDistance($query,$dist,$location)
    {
        return $query->whereRaw('st_distance(location,POINT('.$location.')) < '.$dist);
    }
    public function scopeDay($query,$day = null){
        $day = $day == null ? date('Y-m-d') : $day;
        return $query->whereRaw('created_at BETWEEN "' . $day . ' 00:00:00" AND "' . $day . ' 23:59:59"' );
    }
}
