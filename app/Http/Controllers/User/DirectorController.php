<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-directors');
    }

    /*List of directors*/
    public function index(): View
    {
        $director_role = Role::where('name', 'director')->first();

        $directors = $director_role->users()
            ->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        return view('dashboard.director.index', [
            'directors' => $directors,
        ]);
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
