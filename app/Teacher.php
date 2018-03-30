<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Teacher extends Model
{
  /**************************
   *@timestamps means created_at
   *updated_at
   ***********************************************/
  public $timestamps=false;

  protected $fillable =[ 't_id', 't_name',
    't_email',   't_designation', 'joining_date',
    'promotion_date','type','t_image', 'is_busy',
  ];
}
