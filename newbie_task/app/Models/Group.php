<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_name',
        'password',
        'img1',
        'img2',
        'img3',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
