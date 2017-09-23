<?php

namespace App\models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Database\Eloquent\Model;





class Customer extends Model

{

protected $table = 'customers';

protected $guarded = [];


public function addressbooks(){
	return $this->hasMany('App\models\Addressbook');
}
 public function currentbilling(){
	return $this->hasOne('App\models\Addressbook')->where('is_billing' ,1);
}
public function currentshipping(){
	return $this->hasOne('App\models\Addressbook')->where('is_shipping' ,1);
} 
}



