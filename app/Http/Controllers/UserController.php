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
        $users = $this->userRepository->allUsers($request);
        return  $users;
    }

    public function create()
    {
        return view('pages.create_user');
    }

    public function store(UserRequest $request)
    {
        $user = $this->userRepository->storeUser($request);
        return  $user;    
    }

    public function edit($id)
    {
        $user = $this->userRepository->editUser($id);
        return  $user;       
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->updateUser($request, $id);
        return  $user;
    }
}
