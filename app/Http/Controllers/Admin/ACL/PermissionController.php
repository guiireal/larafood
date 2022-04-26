<?php
namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    public function index()
    {
        $permissions = $this->repository->query()->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $this->repository->query()->create($request->all());

        return redirect()->route('permissions.index')->with('message', 'Registro inserido com sucesso!');
    }

    public function show($id)
    {
        if (!$permission = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        if (!$permission = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        if (!$permission = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('message', 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$permission = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        $permission->delete();

        return redirect()->route('permissions.index')->with('message', 'Registro excluído com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $permissions = $this->repository->query()->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->where('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        })->paginate();

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
}
