<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-directors');
    }

    /*List directors*/
    public function index(): View
    {
        return view('dashboard.director.index');
    }

    /*Director creation form*/
    public function create()
    {
        //
    }

    /*Save the director's record*/
    public function store(Request $request)
    {
        //
    }

    /*Display the data of a specific director */
    public function show($id)
    {
        //
    }

    /*Director actualization form*/
    public function edit($id)
    {
        //
    }

    /*Save the update of the director's record*/
    public function update(Request $request, $id)
    {
        //
    }

    /*Director's logic deleted*/
    public function destroy($id)
    {
        //
    }
}
