<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends BaseModel
{
    protected $fillable = ['name'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id', 'id');
    }
}
