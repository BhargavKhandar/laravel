<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;  // Add this line to enable factory usage

    // Automatically truncate comments to fit the column size
    public function setCommentAttribute($value)
    {
        $this->attributes['comment'] = substr($value, 0, 255);
    }
}
