<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.roles.create', compact('permissions'));
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
            'name' => 'required|unique:roles|max:10',
            'permissions' => 'required',
        ]);

        $role = Role::create($request->only('name'));

        $permissions = $request['permissions'];
        foreach ($permissions as $inputPermission) {
            $permission = Permission::findOrFail($inputPermission);
            $role->givePermissionTo($permission);
        }

        return redirect()->route('roles.index')
            ->with('flash_message', 'Role '.$role->name.' added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('dashboard.roles.edit', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);
        $this->validate($request, [
             'name' => 'required|unique:roles,name,'.$id.'|max:10',
            'permissions' => 'required',
        ]);

        $role->fill($request->only('name'))->save();
        $role->permissions()->sync($request['permissions']);

        return redirect()->route('roles.index')
            ->with('flash_message', 'Role '.$role->name.' updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $deletedRoleName = $role->name;
        $role->delete();

        return redirect()->route('roles.index')
            ->with('flash_message', 'Role '.$deletedRoleName.' deleted.');
    }
}
