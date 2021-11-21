<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class UserController extends Controller
{
    public string $view_title = "View title";
    public string $view_description = "View Description";

    public function __construct()
    {

    }

    public function setViewTitle(string $title): void
    {
        $this->view_title = $title;
    }

    public function setViewDescription(string $description): void
    {
        $this->view_description = $description;
    }

    public function getUsers(): LengthAwarePaginator
    {
        return User::orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();
    }

    /*List users*/
    public function index(): View
    {
        $users = $this->getUsers();

        return view('dashboard.user.index', [
            'title' => $this->view_title,
            'description' => $this->view_description,
            'users' => $users,
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
