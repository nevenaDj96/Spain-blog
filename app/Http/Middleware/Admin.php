<?php


namespace App\Http\Middleware;

use Closure;


class Admin {

    
    public function handle($request, Closure $next)
     
       {
        
        if($request->session()->has('kor')){
            
            $kor=$request->session()->get('kor')[0];
            if($kor->naziv=='admin'){
                return $next($request);
                
            }
            else{
                return redirect()->back()->with('error','Nemate pravo pristupa');
            }
        }
          return redirect()->back()->with('error','Nemate pravo pristupa');
          
      }
    
    
    
}
