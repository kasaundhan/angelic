<?php

namespace App\models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
protected $guarded = [];
protected $table = 'order';
public function orderitems(){
	return $this->hasMany('App\models\OrderItem');
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



