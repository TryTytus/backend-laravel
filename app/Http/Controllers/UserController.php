<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;

class UserController extends Controller
{
    public function index()
    {
        return User::paginate(20);
    }

    public function store(UserRequest $request)
    {

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, int $id): void
    {

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::findOrFail($id);

        $user->update($data);
    }


    public function destroy(int $id): void
    {
        User::destroy($id);
    }



}
