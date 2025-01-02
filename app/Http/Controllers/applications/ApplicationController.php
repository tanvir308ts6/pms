<?php

namespace App\Http\Controllers\applications;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Notifications\ApplicantNotification;
use App\Models\Role;
use App\Models\User;
use App\Models\Jail;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::paginate(2);
        return view('application.index', [
            'applications' => $applications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $role = Role::where('name', 'visitor')->first();

        $applicant = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|max:255',
            'phone_number' => ['required', 'regex:/^01[3-9][0-9]{8}$/'],
            'pin_no' => 'required|string|max:255',
            'relation' => 'required|string|max:255',
            'nid_or_birth_certificate_no' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'role_id' => 'required'
        ]);

        Application::create($applicant);

        
        return redirect()->back()->with('success', 'Visit application submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application  = Application::find($id);
        $pin_data = User::find($application->pin_no);
        $pjd_id= $application->pin_no;
        $pjd = DB::table('jail_user')->where('user_id', (string)$pjd_id)->get();
        $jd = DB::table('jails')->where('id', $pjd[0]->jail_id)->get();
        
        if(!$application){
            abort(404, 'Application not found');
        }
        return view('application.review', [
            'application' => $application,
            'pin_data' => $pin_data,
            'jd' => $jd
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}