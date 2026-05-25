<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        // Provide all paginate arguments to satisfy environments expecting five parameters
        $users = User::paginate(10, ['*'], 'page', null, null);
        return view('users.index', compact('users'));
    }
}
