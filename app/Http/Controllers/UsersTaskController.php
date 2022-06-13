<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\UsersTask;

class UsersTaskController extends Controller
{
    public function index()
    {

        return view('promoter.account', [
            'user' => auth()->user(),
        ]);

    }
  }