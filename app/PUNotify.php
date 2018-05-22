<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PUNotify extends Model
{
    protected $table='profile_update_notify';
    protected $primaryKey = 'id';
      public $timestamps=false;

}
