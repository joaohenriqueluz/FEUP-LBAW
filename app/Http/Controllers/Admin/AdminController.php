<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\UserReport;
use App\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('admin/login');
        }
        //     $post = new Report();
        //     $post->reason = 'blablabla';
        //     $post->id_admin = 4;
        //     $post->id_user = 4;
        //     $post->save();

        //     $question = new UserReport();
        //     $question->id_report = $post->id;
        //     $question->id_user = 4;
        //     $question->save();

        //     // link them together

        //     $question->report()->save($post);

        $admin = Auth::guard('admin')->user();
        $admin_user = Admin::find($admin->id);

        $reports = $admin_user->reports->sortByDesc('time_stamp');
        return view('pages.admin', ['reports' => $reports]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}