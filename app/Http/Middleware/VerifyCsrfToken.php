<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
	protected function isReading($request)
	{
		return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS','DELETE','PUT']);
	}
}
