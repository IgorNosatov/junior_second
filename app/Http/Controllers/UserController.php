<?php

namespace App\Http\Controllers; 

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 1;
        
        $users = $this->userRepository->allUsers($request);
        return view('pages.user', compact('users', 'orderBy', 'sortBy', 'perPage'));
    }

    public function create()
    {
        return view('pages.create_user');
    }

    public function store(UserRequest $request)
    {
        $this->userRepository->storeUser($request);
        return redirect('/user')->with('success', 'user has been added');  
    }

    public function edit($id)
    {
        $user = $this->userRepository->editUser($id);
        return view('pages.edit_user', compact('user'));         
    }

    public function update(UserRequest $request, $id)
    {
        $this->userRepository->updateUser($request, $id);
        return redirect('/user')->with('success', 'user updated!');
    }
}
