<?php

namespace App\Http\Controllers;

use App\Models\UserIdentity;
use App\Http\Requests\StoreUserIdentityRequest;
use App\Http\Requests\UpdateUserIdentityRequest;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class UserIdentityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = UserIdentity::query()->paginate(10, ['*'], 'page', $request->page ?? 0);
        return response()->json($data);
    }

    public function getUserIdentityById(Request $request)
    {
        $result = UserIdentity::query()->findOrFail($request->id);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserIdentityRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserIdentityRequest $request): \Illuminate\Http\JsonResponse
    {
        (new UserIdentity())->query()->create([
            'email'=> $request->email,
            'password'=>$request->password,
            'first_name'=>$request->first_name,
            'role'=>$request->role]);

        return response()->json(['message' => 'User successfully created']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserIdentityRequest  $request
     * @param  \App\Models\UserIdentity  $userIdentity
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $updateUser = UserIdentity::query()->findOrFail($id);
        $updateUser->update([
            'email' => $request->email,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'role' => $request->role
        ]);

        return response()->json(['message' => 'User successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIdentity  $userIdentity
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUserById(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = UserIdentity::query()->findOrFail($request->id)->delete();
        return response()->json(['message' => 'User successfully deleted']);
    }
}
