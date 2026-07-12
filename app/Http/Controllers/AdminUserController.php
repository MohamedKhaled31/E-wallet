<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
{
    $users = User::query()
        ->where('role', '!=', 'admin')
        ->when($request->search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->with('wallet')
        ->latest()
        ->paginate(8);

    return view('admin.users', compact('users'));
}

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'User status updated successfully.');
    }

    public function show(User $user)
    {
        $user->load(['wallet', 'wallet.transactions']);
        return view('admin.userShow', compact('user'));
    }
}
