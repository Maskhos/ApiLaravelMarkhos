<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Hash;
class TokenAuthMiddleware
{
  /*
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request $request
  * @param  \Closure $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
    if($request->token=="maskhos12345"){
      return $next($request);
    }else{
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No Rights to enter here.'])],404);
    }
    //return Auth::onceBasic('email') ? : $next($request);
  }
}
