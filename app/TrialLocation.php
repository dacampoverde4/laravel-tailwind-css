<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TrialLocation extends Model
{
  protected static function boot()
  {
      parent::boot();
      static::addGlobalScope('trial_locations', function(Builder $builder) {
          $builder->orderby('id', 'desc');
      });
  }
}
