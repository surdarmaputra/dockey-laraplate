<?php

namespace App\Http\Controllers\Dashboard\UserAdministrations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.permissions.create', compact('roles'));
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
            'name' => 'required|alpha_dash|max:150|unique:permissions',
            'display_name' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:150',
        ]);

        $permission = Permission::create($this->acceptedParams($request));
       
        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $roleId) {
                $role = Role::findOrFail($roleId);
                $role->attachPermission($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with('flash_message', 'Permission '.$permission->name.' successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::all();
        return view('dashboard.permissions.edit', compact('permission', 'roles'));
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
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|alpha_dash|max:150|unique:permissions,name,'.$id,
            'display_name' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:150',
        ]);

        $permission->fill($this->acceptedParams($request))->save();

        $roles = isset($request['roles']) && $request['roles'] !== null ? $request['roles'] : [];
        $permission->roles()->sync($roles);

        return redirect()->route('permissions.edit', $id)
            ->with('flash_message', 'Permission '.$permission->name.' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $deletedPermissionName = $permission->name;
        
        if (!$permission->built_in) {
            $permission->delete();
            $message = 'Permission '.$deletedPermissionName.' successfully deleted.';
        } else {
            $message = 'Built-in permission '.$deletedPermissionName.' should not be deleted.';
        }

        return redirect()->route('permissions.index')
            ->with('flash_message', 'Permission '.$deletedPermissionName.' deleted');
    }

    private function acceptedParams(Request $request)
    {
        $roleProperties = $request->only('name', 'display_name', 'description');
        $roleProperties['display_name'] = is_null($roleProperties['display_name']) ? ucwords(str_replace(['-', '_'], ' ', $roleProperties['name'])) : $roleProperties['display_name'];
        $roleProperties['description'] = is_null($roleProperties['description']) ? ucwords(str_replace(['-', '_'], ' ', $roleProperties['name'])) : $roleProperties['description'];

        return $roleProperties;
    }
}
