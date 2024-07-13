<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Admin::with('roles');
        $page = 50;
        if ($paginate = $request->paginate) {
            $page = $paginate;
        }
        $viewData = [
            'items' => $accounts->paginate($page),
            'queries' => $request->query(),
            'route' => 'accounts',
            'header' => 'Accounts',
            'display_fields' => [
                'id' => [
                    'title' => '#',
                ],
                'name' => [
                    'title' => 'Name',
                ],
                'email' => [
                    'title' => 'Email',
                ],
                'status' => [
                    'title' => 'Active',
                ],
                'type' => [
                    'title' => 'Roles',
                    'func' => function ($item) {
                        $roles = $item->roles->pluck('name')->toArray();
                        $roleLabels = array_map(function ($role) {

                            return RoleEnum::from($role)->label();
                        }, $roles);
                        return Arr::join($roleLabels, ', ');
                    },
                ],
                'created_at' => [
                    'title' => 'Created At',
                    'func' => function ($item) {
                        return $item->created_at->diffForHumans();
                    },
                ],
                'updated_at' => [
                    'title' => 'Updated At',
                    'func' => function ($item) {
                        return $item->updated_at->diffForHumans();
                    },
                ],
                'actions' => [
                    'title' => 'Actions',
                    'items' => [
                        'edit' => true,
                        'delete' => true,
                    ],
                ],
            ],
        ];

        return view('backend.layouts.crud.base_list_table')->with($viewData);
    }

    public function create()
    {
        return view('backend.settings.add');
    }

    public function add(Request $request)
    {
        Admin::query()->create($request->all(['key', 'value']));
        return redirect(route('admin.settings.list'));
    }

    public function edit(Request $request)
    {
        $account = Admin::with('roles', 'permissions')->findOrFail($request->id);
        $groupedPermissions = collect(PermissionEnum::cases())->groupBy(function ($p) {
            return explode('_', $p->value)[1];
        });
        return view('backend.salers.edit', compact('account', 'groupedPermissions'));
    }

    public function update(Request $request)
    {
        $account = Admin::with('roles', 'permissions')->findOrFail($request->id);
        $basicReq = $request->all(['name']);
        $account->update($basicReq);

        // Process permissions and roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);
        $account->syncRoles($roles);
        $account->syncPermissions($permissions);

        return redirect(route('admin.accounts.list'));
    }

    public function delete(Request $request)
    {
        if (Admin::destroy($request->id)) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
