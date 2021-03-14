<?php

namespace App\Http\Middleware;

use Closure;

class SwitchDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $company = $request->company_name;
        $subdomain = \App\Models\Subdomain::where('sub_domain', $company)->first();
        if(!$subdomain) {
            // redirect to page telling user to create new subdomai
            // die('we are dead');
            $request->session()->flash('alert-danger', 'Invalid sub domain. Please create your custom sub domain here');
            return redirect()->to('http://benndip.me');
        }

        // dd($subdomain->toArray());


        $db = 'tenant_' . $company; 
        config(['database.connections.mysql.database' => $db]); 
        \DB::reconnect('mysql');

        return $next($request);
    }
}
