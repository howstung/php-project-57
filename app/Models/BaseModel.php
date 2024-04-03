<?php

namespace App\Models;

use App\Models\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;
    use HasTimestamp;
}
