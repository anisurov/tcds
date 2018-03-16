<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseToSemester extends Model
{
  protected $table='course_in_current_semester';
 protected $primaryKey = 'cis_id';    
   public $timestamps=false;

}
