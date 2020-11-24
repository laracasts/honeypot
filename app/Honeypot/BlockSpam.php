<?php

namespace App\Honeypot;

use Closure;
use Illuminate\Http\Request;

class BlockSpam
{
    protected Honeypot $honeypot;

    public function __construct(Honeypot $honeypot)
    {
        $this->honeypot = $honeypot;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->honeypot->detect()) {
            return $this->honeypot->abort();
        }

        return $next($request);
    }
}
