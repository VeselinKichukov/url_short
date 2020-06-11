<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlShort extends Model
{
    protected $table = 'url_short';
    protected $primaryKey = 'id';

    protected $casts = [
        'private' => 'boolean'
    ];

    protected $fillable = [
        'url',
        'short',
        'description',
        'count',
        'private',
    ];
}
