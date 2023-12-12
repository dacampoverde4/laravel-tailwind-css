<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportblock extends Model
{
    protected $table = 'report_block';

    protected $fillable = [
        'status'
    ];


    
    public function userdisplayname()
    {
        return $this->belongsTo('App\User', 'block_id');
    }

    public function getReportStatusDisplayAttribute()
    {
        if($this->status)
            return 'Complete';

        return 'In complete';

    }
}
