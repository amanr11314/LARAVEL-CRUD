<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['name' => 'John', 'email' => 'john@example.com'],
            ['name' => 'Jane', 'email' => 'jane@example.com'],
            ['name' => 'David', 'email' => 'david@example.com'],
        ];
        // $users = [];

        return view('users.all', compact('users'));
    }
}