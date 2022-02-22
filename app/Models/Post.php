<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'conteudo'
    ];

    protected $guarded = [
        'id',
        'id_tipospost',
        'created_at',
        'update_at'
    ];

    public function tiposPost()
    {
        return $this->hasOne('app\Models\TiposPost', 'id_tipospost', 'id');
    }
}
