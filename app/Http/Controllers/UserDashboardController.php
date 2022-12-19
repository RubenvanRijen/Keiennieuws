<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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

    public function editUser($id)
    {

        $user = User::find($id);
        $role = $user->getRoleNames()[0];
        return view('/pages/dashboard/admin/users/userEdit', ['user' => $user, 'role' => $role]);
    }

    public function updateUser(Request $request,  $id)
    {
        if ($id === null) {
            return back()->with('error', "Oeps er ging iets miss");
        }
        $rule = ['required', 'string', 'email', 'max:255'];
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user === null) {
            $rule = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $user = User::find($id);
        }

        $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'min:3'],
            'lastname' => ['required', 'string', 'max:255', 'min:3'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'house_number' => 'required',
            'city' => ['required', 'string', 'max:255', 'min:3'],
            'street_name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => $rule,
            'role' => ['required']
        ]);

        $user->update(
            [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'postcode' => $request->postcode,
                'house_number' => $request->house_number,
                'city' => $request->city,
                'gender' => $request->gender,
                'street_name' => $request->street_name,
                'email' => $request->email,
            ]
        );
        //remove the current role and add a new one
        $currentRole = $user->getRoleNames()[0];
        $user->removeRole($currentRole);
        $user->assignRole($request->role);

        $message = "U heeft succesvol de gebruiker " . $user->firstname . " " . $user->lastname . " aangepast";
        return back()->with('success', $message);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $message = "U heeft succesvol de gebruiker " . $user->firstname . " " . $user->lastname . " verwijdert";
        $user->delete();
        return back()->with('success', $message);
    }

    public function addUser()
    {
        $roles = Role::all()->pluck('name');
        return view('/pages/dashboard/admin/users/userAdd', ['roles' => $roles]);
    }

    public function postUser(Request $request)
    {

        $validation =  $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'min:3'],
            'lastname' => ['required', 'string', 'max:255', 'min:3'],
            'postcode' => 'required|postal_code:NL,DE,FR,BE',
            'house_number' => 'required',
            'city' => ['required', 'string', 'max:255', 'min:3'],
            'street_name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required']
        ]);

        $user = new User();
        $user->fill($validation);
        $user->password = Hash::make('Test123?');
        $user->save();
        $message = "U heeft succesvol de gebruiker " . $user->firstname . " " . $user->lastname . " aangemaakt";
        return back()->with('success', $message);
    }
}
