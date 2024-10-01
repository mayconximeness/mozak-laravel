<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;

class JWTAuthController extends Controller
{
    // User registration
    public function register(Request $request)
    {
        $errors = [];

        // Validação do username
        if (empty($request->username) || !is_string($request->username) || strlen($request->username) > 255) {
            $errors['username'] = 'O campo username é obrigatório e deve ser uma string com no máximo 255 caracteres.';
        }
    
        // Validação do email
        if (empty($request->email) || !filter_var($request->email, FILTER_VALIDATE_EMAIL) || strlen($request->email) > 255) {
            $errors['email'] = 'O campo email é obrigatório, deve ser um endereço de email válido e ter no máximo 255 caracteres.';
        } elseif (User::where('email', $request->email)->exists()) {
            $errors['email'] = 'O email já está em uso.';
        }
    
        // Validação da password
        if (empty($request->password) || strlen($request->password) < 6) {
            $errors['password'] = 'O campo password é obrigatório e deve ter pelo menos 6 caracteres.';
        }
    
        // Verifica se houve erros de validação
        if (!empty($errors)) {
            return response()->json(['error' => $errors], 400);
        }
    
        $user = User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'uuid_code' => Str::uuid(), // Gera um UUID automaticamente
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }

    // User login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Get the authenticated user.
            $user = auth()->user();

            // (optional) Attach the role to the token.
            $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    // Get authenticated user
    public function getUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    // User logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
