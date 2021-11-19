<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    use HasFactory;
    protected $appends = [
        'text'
    ];

    public function getTextAttribute($value)
    {
        return $this->name;
    }

    protected $guarded = [];
}
