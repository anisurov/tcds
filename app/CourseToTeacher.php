<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseToTeacher extends Model
{
  protected $table='course_alloted_to_teacher';
 protected $primaryKey = 'calt_id';    
   public $timestamps=false;

}
