<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use App\Models\RoleHasPermission;

class UsersController extends Controller
{
    public function index()
    {



        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('name', 'id');

        $institutions = Institution::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('roles', 'institutions'));
    }

    public function store(StoreUserRequest $request)
    {
        // Create the user with the provided data
        $user = User::create($request->all());

        // Retrieve the roles to be assigned to the user
        $roles = Role::whereIn('id', $request->input('roles', []))
            ->pluck('name')
            ->toArray();

        // Assign the roles to the user
        $user->syncRoles($roles);

        // Assign permissions associated with each role to the user
        foreach ($request->input('roles', []) as $roleId) {
            // Get the permissions for the role
            $roleHasPermissions = RoleHasPermission::where('role_id', $roleId)->pluck('permission_id');

            // Insert permissions for the user, avoiding duplicates
            foreach ($roleHasPermissions as $permissionId) {
                \DB::table('model_has_permissions')->updateOrInsert(
                    [
                        'permission_id' => $permissionId,
                        'model_id' => $user->id,
                    ],
                    [
                        'model_type' => User::class, // Adjust if using polymorphic relations
                    ]
                );
            }
        }

        return redirect()->route('admin.users.index');
    }


    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Show the form for editing the specified User.
     *
     * @param User $user
     * @return Response
     */
    /******  671ce7ee-57ee-4e17-8a2e-a04dddb523a1  *******/
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('name', 'id');

        $institutions = Institution::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'institution');


        return view('admin.users.edit', compact('roles', 'institutions', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // Update the user with validated data
        $user->update($request->all());

        // Retrieve the roles to be assigned
        $roles = Role::whereIn('id', $request->input('roles', []))
            ->pluck('name')
            ->toArray();


        // Sync roles
        $user->syncRoles($roles);

        // Sync permissions associated with the selected roles
        \DB::table('model_has_permissions')->where('model_id', $user->id)->delete(); // Clear old permissions

        foreach ($request->input('roles', []) as $roleId) {
            $rolePermissions = RoleHasPermission::where('role_id', $roleId)->pluck('permission_id');

            foreach ($rolePermissions as $permissionId) {
                \DB::table('model_has_permissions')->updateOrInsert(
                    [
                        'permission_id' => $permissionId,
                        'model_id' => $user->id,
                    ],
                    [
                        'model_type' => User::class, // Adjust if using polymorphic relations
                    ]
                );
            }
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'institution');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
