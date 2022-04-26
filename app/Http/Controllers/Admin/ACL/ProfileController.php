<?php
namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    public function index()
    {
        $profiles = $this->repository->query()->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    public function store(ProfileRequest $request)
    {
        $this->repository->query()->create($request->all());

        return redirect()->route('profiles.index')->with('message', 'Registro inserido com sucesso!');
    }

    public function show($id)
    {
        if (!$profile = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.show', compact('profile'));
    }

    public function edit($id)
    {
        if (!$profile = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, $id)
    {
        if (!$profile = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        $profile->update($request->all());

        return redirect()->route('profiles.index')->with('message', 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$profile = $this->repository->query()->find($id)) {
            return redirect()->back();
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('message', 'Registro excluído com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $profiles = $this->repository->query()->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->where('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        })->paginate();

        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
    }
}
