<?php

namespace App\Models\Traits;

trait HasTimestamp
{
    public function getCreatedAt(string $format = 'd.m.Y'): string
    {
        return $this->created_at->format($format);
    }
}
