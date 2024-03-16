<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
        if ($request->user()) {
            // $role;
            // if(count($roles) > 1){
            //     $role = explode(',', $roles[0]);
            // }
            if($role == 'tutor' || $role == 'institution'){
                if($request->user()->tutor->isEmpty()){
                    abort(403, 'Unauthorized');
                }else{
                    return $next($request);
                }
            }else if($role == 'school'){
                if($request->user()->school->isEmpty()){
                    abort(403, 'Unauthorized');
                }else{
                    return $next($request);
                }
            }else if($role == 'shuttle'){
                if($request->user()->shuttle->isEmpty()){
                    abort(403, 'Unauthorized');
                }else{
                    return $next($request);
                }
            }else if($role == 'organiser'){
                if($request->user()->organiser->isEmpty()){
                    abort(403, 'Unauthorized');
                }else{
                    return $next($request);
                }
            }
            else if($role == 'admin'){
                if($request->user()->admin->isEmpty()){
                    abort(403, 'Unauthorized');
                }else{
                    return $next($request);
                }
            }
        }
        abort(403, 'Unauthorized');
    }
}
