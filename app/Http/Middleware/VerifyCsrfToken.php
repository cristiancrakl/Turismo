<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Exclude auth routes from CSRF verification when using tunnels (Cloudflare Quick Tunnel issue)
        // This is temporary for testing. Remove in production or fix properly with trusted proxies.
        'register',
        'login',
        'logout',
        'password/email',
        'password/reset',
    ];
}
