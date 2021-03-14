<?php

namespace App\Http\Controllers;

use App\Models\Subdomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Database\OTF;
use Illuminate\Support\Facades\Artisan;
use App\Models\House;

class TenantController extends Controller
{
    public function __construct() {
        $this->middleware('switch-db', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_name)
    {
        $houses = House::all();
        // $company = Company::findOrFail($company_name);
        // $users = User::where('company_id', $company->id)->get();
        return view('index',
            [
                'company_name' => $company_name, 
                'houses' => $houses
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'sub_domain' => 'required|unique:subdomains,sub_domain'
        ]);

        $existingSubDomain = Subdomain::where('sub_domain', $request->sub_domain)->first(); 
        if($existingSubDomain) {
            // flash error
            $request->session()->flash('alert-danger', 'Subdomain already taken. Please choose another one');
            return redirect()->back();
        }

        $tenant = new Subdomain;
        $tenant->sub_domain = $request->sub_domain;
        $tenant->url = $request->sub_domain . ".benndip.me";
        $tenant->save();

        

        $db_name =  "tenant_" . $request->sub_domain;
        DB::statement("CREATE DATABASE ".$db_name.";");   
        $otf = new OTF(['database' => $db_name]);
        Artisan::call('migrate', array('--database'=>$db_name));
        Artisan::call('db:seed', array('--database'=>$db_name));
        return redirect('http://' . $request->sub_domain . '.benndip.me/welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
