<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class real_estate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'real_estate';

    /**
     * The attributes that should be mutated to dates.
     * scratchcode.io
     * @var array
     */
    protected $dates = [ 'deleted_at' ];
}
