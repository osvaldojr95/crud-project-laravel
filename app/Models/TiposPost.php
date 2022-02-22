<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposPost extends Model
{
    protected $table = 'tipospost';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];
}
