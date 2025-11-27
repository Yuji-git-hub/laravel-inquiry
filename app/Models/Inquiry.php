<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'type',
        'content',
    ];

    protected $casts = [
        'type' => \App\Enums\InquiryType::class,
    ];
}
