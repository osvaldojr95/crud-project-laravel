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

    public function tiposPost()
    {
        return $this->belongsTo('app\Models\Post', 'id_tipospost', 'id');
    }
}
