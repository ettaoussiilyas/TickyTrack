<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
    // ... other middlewares
    'role' => \App\Http\Middleware\CheckRole::class,
    ];
}
