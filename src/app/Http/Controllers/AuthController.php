<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller {
    protected $userService;

    public function __construct( UserService $userService ) {
        $this->userService = $userService;
    }

    public function view() {
        if (auth()->check()) {
            return redirect()->route('note.view');
        }
        return view('auth.login', [
            'message' => 'Sign in to start taking note',
            'pageName' => 'Login'
        ]);
    }

    public function registerView() {
        if (auth()->check()) {
            return redirect()->route('note.view');
        }
        return view('auth.register', [
            'message' => 'Sign up to start taking note',
            'pageName' => 'Sign Up'
        ]);
    }

    public function login(LoginRequest $request) {
        $credentials = $request->all();
        if (Auth::attempt($credentials)) {
            return responseOK('Login Success');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }

    public function register(Request $request) {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $user = $this->userService->create($data);
            DB::commit();
            auth()->login($user);
            return responseOK($user);
        } catch(\Exception $e) {
            return responseError($e, $e->getMessage());
        }
    }
}
