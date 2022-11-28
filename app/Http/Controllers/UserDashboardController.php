<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //TODO de juiste gegevens in de html table zetten en het verwijderen maken
    public function indexUsers()
    {
        $users = User::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('/pages/dashboard/admin/users/usersIndex', ['users' => $users]);
    }

    public function indexUser($id)
    {
        $user = User::find($id);
        return view('/pages/dashboard/admin/users/userIndex', ['user' => $user]);
    }

    function sortFunction($a, $b)
    {
        return strtotime($a[1]) - strtotime($b[1]);
    }

    public function editUser()
    {
    }

    public function updateUser(Request $request,  $id)
    {
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $message = "U heeft succesvol de gebruiker " . $user->firstname . " " . $user->lastname . " verwijdert";
        $user->delete();
        return back()->with('success', $message);
    }
}
