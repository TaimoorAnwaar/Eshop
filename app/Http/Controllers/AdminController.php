<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

   
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,manager,customer',
        ]);
    
        $user->role = $request->input('role');
        $user->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Role assigned successfully!');
    }
}    
 
