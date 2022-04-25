<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanDetailRequest;
use App\Models\Plan;
use App\Models\PlanDetail;

class PlanDetailController extends Controller
{
    protected $repository;
    protected $plan;

    public function __construct(PlanDetail $planDetail, Plan $plan)
    {
        $this->repository = $planDetail;
        $this->plan = $plan;
    }

    public function index($planUrl)
    {
        if (!$plan = $this->plan->query()->where('url', $planUrl)->first()) {
            return redirect()->back();
        };

        $planDetails = $plan->planDetails()->paginate();

        return view('admin.pages.plans.details.index', ['plan' => $plan, 'planDetails' => $planDetails]);
    }

    public function create($planUrl)
    {
        if (!$plan = $this->plan->query()->where('url', $planUrl)->first()) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }

    public function store(PlanDetailRequest $request, $planUrl)
    {
        if (!$plan = $this->plan->query()->where('url', $planUrl)->first()) {
            return redirect()->back();
        };

        $plan->planDetails()->create($request->all());

        return redirect()->route('plans.details.index', ['planUrl' => $plan->url])->with('message', 'Registro inserido com sucesso!');
        ;
    }

    public function edit($planUrl, $planDetailId)
    {
        $plan = $this->plan->query()->where('url', $planUrl)->first();
        $planDetail = $this->repository->query()->find($planDetailId);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'planDetail' => $planDetail,
        ]);
    }

    public function update(PlanDetailRequest $request, $planUrl, $planDetailId)
    {
        $plan = $this->plan->query()->where('url', $planUrl)->first();
        $planDetail = $this->repository->query()->find($planDetailId);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        };

        $planDetail->update($request->all());

        return redirect()->route('plans.details.index', [$plan->url])->with('message', 'Registro atualizado com sucesso!');
        ;
    }

    public function show($planUrl, $planDetailId)
    {
        $plan = $this->plan->query()->where('url', $planUrl)->first();
        $planDetail = $this->repository->query()->find($planDetailId);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'planDetail' => $planDetail,
        ]);
    }

    public function destroy($planUrl, $planDetailId)
    {
        $plan = $this->plan->query()->where('url', $planUrl)->first();
        $planDetail = $this->repository->query()->find($planDetailId);

        if (!$plan || !$planDetail) {
            return redirect()->back();
        };

        $planDetail->delete();

        return redirect()->route('plans.details.index', [$plan->url])->with('message', 'Registro excluído com sucesso!');
    }
}
