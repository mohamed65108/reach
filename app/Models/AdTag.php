<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdTag extends Pivot
{
    use HasFactory;

    protected $fillable = ['ad_id', 'tag_id'];
}
