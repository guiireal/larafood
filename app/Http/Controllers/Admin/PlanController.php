<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', ['plans' => $plans]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(PlanRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index')->with('message', 'Registro inserido com sucesso!');
        ;
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.show', ['plan' => $plan]);
    }

    public function destroy($url)
    {
        $plan = $this->repository->with('planDetails')->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        if ($plan->planDetails->count()) {
            return redirect()->back()->with('error', 'Existem detalhes cadastrados para este plano. Exclua-os antes de excluir o plano!');
        }

        $plan->delete();

        return redirect()->route('plans.index')->with('message', 'Registro excluído com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', ['plans' => $plans, 'filters' => $filters]);
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        return view('admin.pages.plans.edit', ['plan' => $plan]);
    }

    public function update(PlanRequest $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan) {
            return redirect()->back();
        }

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('message', 'Registro atualizado com sucesso!');
    }
}
