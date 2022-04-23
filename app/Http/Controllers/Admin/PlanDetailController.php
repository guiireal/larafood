<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Http\Request;

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
        if (!$plan = $this->plan->where('url', $planUrl)->first()) {
            return redirect()->back();
        };

        $planDetails = $plan->planDetails()->paginate();

        return view('admin.pages.plans.details.index', ['plan' => $plan, 'planDetails' => $planDetails]);
    }

    public function create($planUrl)
    {
        if (!$plan = $this->plan->where('url', $planUrl)->first()) {
            return redirect()->back();
        };

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }

    public function store(Request $request, $planUrl)
    {
        if (!$plan = $this->plan->where('url', $planUrl)->first()) {
            return redirect()->back();
        };

        $plan->planDetails()->create($request->all());

        return redirect()->route('plans.details.index', ['planUrl' => $plan->url]);
    }
}
