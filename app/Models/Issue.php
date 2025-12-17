<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'repo',
        'github_id',
        'title',
        'body',
        'html_url',
        'created_at_github'
    ];
}