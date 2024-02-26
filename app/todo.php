<?php

namespace App;
use App\step;

use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
  protected $fillable = ['name','completed','user_id'];


  public function step()
{
  return $this->hasOne(step::class);
}
}
