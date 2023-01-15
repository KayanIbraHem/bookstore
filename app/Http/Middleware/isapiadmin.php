<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

use Illuminate\Http\Request;

class isapiadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset($request->acces_token) && $request->acces_token !=null){
            $user=User::where('acces_token',$request->acces_token)->where('is_admin',1)->first();
            if($user)return $next($request);
        }
        return response()->json(['error'=>'Not Vaild Admin']);
    }
}
