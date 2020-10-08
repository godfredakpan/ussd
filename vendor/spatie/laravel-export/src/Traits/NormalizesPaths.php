<?php

namespace Spatie\Export\Traits;

use Illuminate\Support\Str;

trait NormalizesPaths
{
    protected function normalizePath(string $path)
    {
        if (! Str::contains(basename($path), '.')) {
            $path .= '/index.html';
        }

        return ltrim($path, '/');
    }
}
