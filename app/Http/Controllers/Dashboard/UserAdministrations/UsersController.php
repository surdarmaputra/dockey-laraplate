<?php

namespace App\Http\Controllers\Dashboard\UserAdministrations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        if ($request->has('role')) {
            $roleList = explode(',', $request->role);
            $roles = Role::whereIn('name', $roleList)->orWhereIn('id', $roleList)->get();
            if (count($roles) > 0) {
                $users = [];
                foreach ($roles as $role) {
                    foreach ($role->user as $user) {
                        array_push($users, $user);
                    }
                }
            } else $users = [];
        } else {
            $users = User::all();
        }
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_dash|max:20|unique:users',
            'full_name' => 'required|max:500',
            'address' => 'nullable|max:255',
            'phone_number' => 'nullable|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'active' => 'required|boolean',
        ]);

        $user = User::create($this->acceptedParams($request));
        
        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $inputRole) {
                $role = Role::where(['id' => $inputRole])->firstOrFail();
                $user->attachRole($role);
            }
        }
        return redirect()->route('users.index')
            ->with('flash_message', 'New user successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'username' => 'required|alpha_dash|max:20|unique:users,username,'.$id,
            'full_name' => 'required|max:500',
            'address' => 'nullable|max:255',
            'phone_number' => 'nullable|max:20|unique:users,phone_number,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6|confirmed',
            'active' => 'required|boolean',
        ]);
       
        $inputData = $this->acceptedParams($request);
        if ($request->has('password') && $request->password !== NULL) 
            $inputData['password'] = $request->password;
        else 
            unset($inputData['password']);
        $user->fill($inputData)->save();

        $roles = $request['roles'];
        if (isset($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('users.edit', $id)
            ->with('flash_message', 'User '.$user->username.' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!$user->built_in) {
            $user->delete();
            $message = 'User successfully deleted.';
        } else {
            $message = 'Built-in user can not be deleted.';
        }
       
        return redirect()->route('users.index')
            ->with('flash_message', $message);
    }

    private function acceptedParams(Request $request)
    {
        return $request->only([
            'username',
            'full_name',
            'address',
            'phone_number',
            'email',
            'password',
            'active',
        ]);
    }
}
