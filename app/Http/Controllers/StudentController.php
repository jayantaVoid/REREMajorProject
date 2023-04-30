<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('student')) {
            return view('student-dashboard');
        }
    }
}
