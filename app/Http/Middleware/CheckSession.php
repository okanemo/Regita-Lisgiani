<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Http\Traits\GeneralServices;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    use GeneralServices;
    public function handle($request, Closure $next)
    {
        $data = session('Users');
        if (empty($data)) {
            return redirect('/admin/logout');
        } 
        $this->setMenu();
        return $next($request);
        
    }
}
