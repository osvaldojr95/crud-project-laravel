<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'id_tipospost',
        'conteudo'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    public function tipospost()
    {
        return $this->hasOne(TiposPost::class ,'id', 'id_tipospost');
    }
}
