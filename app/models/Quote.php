<?php

namespace App\models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
class Quote extends Model
{
protected $guarded = [];

public function quoteitems(){
	return $this->hasMany('App\models\QuoteItem');
}
public function customer(){
	return $this->belongsTo('App\models\Customer');
}
public function ringname(){
	return $this->belongsTo('App\models\Ringsize');
}
public function metalname(){
	return $this->belongsTo('App\models\Metals');
}
}



