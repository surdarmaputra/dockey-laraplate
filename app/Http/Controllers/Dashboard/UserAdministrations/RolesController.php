<?php

namespace App\Http\Controllers\Dashboard\UserAdministrations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RolesController extends Controller
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
            'name' => 'required|alpha_dash|unique:roles|max:50',
            'display_name' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:150',
            'permissions' => 'required',
        ]);

        $role = Role::create($this->acceptedParams($request));

        $permissions = $request['permissions'];
        foreach ($permissions as $inputPermission) {
            $permission = Permission::findOrFail($inputPermission);
            $role->attachPermission($permission);
        }

        return redirect()->route('roles.index')
            ->with('flash_message', 'Role '.$role->name.' successfully created.');
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
            'name' => 'required|alpha_dash|unique:roles,name,'.$id.'|max:50',
            'display_name' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:150',
            'permissions' => 'required',
        ]);

        $role->fill($this->acceptedParams($request))->save();
        $role->permissions()->sync($request['permissions']);

        return redirect()->route('roles.edit', $id)
            ->with('flash_message', 'Role '.$role->name.' successfully updated.');
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

        if (!$role->built_in) {
            $role->delete();
            $message = 'Role '.$deletedRoleName.' successfully deleted.';
        } else {
            $message = 'Built-in role '.$deletedRoleName.' should not be deleted.';
        }
        
        return redirect()->route('roles.index')
            ->with('flash_message', $message);
    }

    private function acceptedParams(Request $request)
    {
        $roleProperties = $request->only('name', 'display_name', 'description');
        $roleProperties['display_name'] = is_null($roleProperties['display_name']) ? ucwords(str_replace(['-', '_'], ' ', $roleProperties['name'])) : $roleProperties['display_name'];
        $roleProperties['description'] = is_null($roleProperties['description']) ? ucwords(str_replace(['-', '_'], ' ', $roleProperties['name'])) : $roleProperties['description'];

        return $roleProperties;
    }
}
