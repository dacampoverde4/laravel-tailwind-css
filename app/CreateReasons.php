<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CreateReasons extends Model
{
  protected static function boot()
  {
      parent::boot();
      static::addGlobalScope('orderStatus', function(Builder $builder) {
          $builder->orderby('sort', 'asc');
      });
  }
}
