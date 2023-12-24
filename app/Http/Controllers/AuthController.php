<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 200,
                'body' => [
                    'accessToken' => $token,
                    'currentUser' => $user->name,
                    'cartId' => $user->id,
                ]
            ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'USER',
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        $shoppingCartController = new ShoppingCartController();
        $shoppingCartController->createDefaultShoppingcart($user->id);
        return response()->json([
            'status' => 200,
                'accessToken' => $token,
                'currentUser' => $user->name,
                'cartId' => $user->id,

        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json([
            'name' => $user->name,
            'admin' => $user->role == "ADMIN" ? true : false,
        ]);
    }

    public function getAllUser(Request $request)
    {
        $user = DB::table('users')->where('role', 'ADMIN')->orWhere('role', 'USER')->get();
        return response()->json($user);
    }

    public function deleteUser(Request $request, $email)
    {
        $user = DB::table('users')->where('email', $email)->delete();
        return response()->json($user);
    }

}
