<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Expense\Http\Requests\StoreInvestmentRequest;
use App\Expense\Http\Requests\UpdateInvestmentRequest;
use App\Expense\Http\Resources\InvestmentsResource;
use App\Expense\Models\Investment;
use App\Expense\Services\InvestmentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvestmentController extends Controller
{
    public function __construct(protected InvestmentService $investmentService)
    {
    }

    public function userInvestments(): AnonymousResourceCollection
    {
        $investments = $this->investmentService
            ->userInvestments();

        return InvestmentsResource::collection($investments);
    }

    public function store(StoreInvestmentRequest $request): void
    {
        $this->investmentService
            ->create($request->validated());
    }

    public function update(UpdateInvestmentRequest $request, Investment $investment): void
    {
        $this->investmentService
            ->update(
                $investment->id,
                $request->validated()
            );
    }

    public function destroy(Investment $investment): void
    {
        $this->investmentService->delete($investment->id);
    }
}
