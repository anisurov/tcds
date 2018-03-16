<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseRequest extends Model
{
  protected $table='course_request';
 protected $primaryKey = 'id';
   public $timestamps=false;

}
