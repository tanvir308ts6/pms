<?php

namespace App\Http\Controllers\User;


use App\Models\Role;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class DirectorController extends UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:manage-directors');
    }

//    public function getUsers(): LengthAwarePaginator
//    {
//        $director_role = Role::where('name', 'director')->first();
//
//        return $director_role->users()
//            ->orderBy('first_name', 'asc')
//            ->orderBy('last_name', 'asc')
//            ->paginate();
//    }

    /*List users*/
//    public function index(): View
//    {
//        $users = $this->getUsers();
//        return view('dashboard.user.index', [
//            'title' => 'List of directors',
//            'description' => 'List of users with the role of director registered in the system.',
//            'users' => $users,
//        ]);
//    }
}
