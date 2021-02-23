<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if(Auth::check() && $user->isAdmin()){
            return $next($request);
        }else{

            $notification = [
                'message' => 'You don\'t have access to this page.',
                'alert-type' => 'error'
            ];
            return redirect('/home')->with($notification);
        }
      
    }
}
