<?php
namespace App\Http\Controllers\AdminUI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->get();
        return view('adminui.users.index', compact('users'));
    }

    public function create()
    {
        // Daftar menu/module yang bisa diakses user (mudah ditambah)
        $menuList = [
            'Dashboard',
            'Profile',
            'Users',
            'About Page',
            'Services',
            'Contact Page',
            'Projects',
            'Blog',
            'Tables',
            'Billing',
            'Settings',
            'Logout',
        ];
        return view('adminui.users.create', compact('menuList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:Super Admin,Admin,Staff',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',
        ]);

        $role = $request->input('role', 'Admin');
        $permissions = $request->input('permissions', []);

        // Always store permissions as array (even for Super Admin).
        // If you want "full access" semantics, keep all menus checked or use null intentionally.
        $savePermissions = is_array($permissions) ? array_values($permissions) : [];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'permissions' => $savePermissions,
        ]);

        return redirect()->route('adminui.users.index')->with('success', 'User berhasil ditambahkan!');
    }
    public function edit(User $user)
    {
        $menuList = [
            'Dashboard',
            'Profile',
            'Users',
            'About Page',
            'Services',
            'Contact Page',
            'Projects',
            'Blog',
            'Tables',
            'Billing',
            'Settings',
            'Logout',
        ];
        return view('adminui.users.edit', compact('user', 'menuList'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string|in:Super Admin,Admin,Staff',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role tidak valid.',
        ]);

        $role = $request->input('role', 'Admin');
        $permissions = $request->input('permissions', []);
        // Always store permissions as array to make edits effective even for Super Admin
        $savePermissions = is_array($permissions) ? array_values($permissions) : [];

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'permissions' => $savePermissions,
        ]);

        return redirect()->route('adminui.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('adminui.users.index')->with('success', 'User berhasil dihapus!');
    }
}
