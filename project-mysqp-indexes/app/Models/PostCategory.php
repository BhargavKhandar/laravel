<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Pivot
{
    use HasFactory;  // Add this line to enable factory usage

    // Define any relationships and other model methods here
}
