<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserRepository {

    public function allUsers(Request $request)
    {
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 10;

        $users = User::query();

        if (request()->get('search')) {
            $search = $request->get('search');
            $users->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
        }

        if ($request->has('orderBy')) {
            $orderBy = $request->query('orderBy');
        }
        if ($request->has('sortBy')) {
            $sortBy = $request->query('sortBy');
        }
        if ($request->has('perPage')) {
            $perPage = $request->query('perPage');
        }

        $users = $users
            ->paginate($perPage)
            ->appends('sortBy', request('sortBy'))
            ->appends('perPage', request('perPage'))
            ->appends('orderBy', request('orderBy'));


        return view('pages.user', compact('users', 'orderBy', 'sortBy', 'perPage'));
    }


    public function storeUser(UserRequest $request)
    {
        $data = new User([
            'name' => $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> Hash::make($request->get('password'))
        ]);
 
        $data->save();
        return redirect('/user')->with('success', 'user has been added');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('pages.edit_user', compact('user'));        
    }

    public function updateUser(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return redirect('/user')->with('success', 'user updated!');
    }
}