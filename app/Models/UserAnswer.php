<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function weight()
    {
        return $this->belongsTo(Weight::class);
    }
}
