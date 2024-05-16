<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->latest('id')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->role->all()->groupBy('group');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request->password);
        $dataCreate['image'] = $this->user->saveImage($request);

        $user = $this->user->create($dataCreate);
        $user->images()->create(['url' => $dataCreate['image']]);
        $user->roles()->attach($dataCreate['role_ids']);
        return redirect()->route('users.index')->with(['message' => 'User create successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user->findOrFail($id)->load('roles');
        $roles = $this->role->all()->groupBy('group');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $dataUpdate = $request->except('password');
        $user = $this->user->findOrFail($id)->load('roles');

        if ($request->password) {
            $dataUpdate['password'] = Hash::make($request->password);
        }
        $currentImage = $user->images ? $user->images->first()->url : '';
        $dataUpdate['image'] = $this->user->updateImage($request, $currentImage);

        $user->update($dataUpdate);
        $user->images()->updateOrCreate(['url' => $dataUpdate['image']]);
        $user->roles()->sync($dataUpdate['role_ids']);
        return redirect()->route('users.index')->with(['message' => 'User updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
 {
    $user = $this->user->findOrFail($id)->load('role');
    $user->images()->delete();
    $imageName = $user->images ? $user->images->first()->url : '';
    $this->user->deleteImage($imageName);
    $user->delete();
    return redirect()->route('users.index')->with(['message' => 'User deleted successfully']);
 }

}
