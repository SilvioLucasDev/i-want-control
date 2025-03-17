<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Expense\Http\Requests\StoreInvestmentRequest;
use App\Expense\Http\Requests\UpdateInvestmentRequest;
use App\Expense\Http\Resources\InvestmentsResource;
use App\Expense\Models\Investment;
use App\Expense\Services\InvestmentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class InvestmentController extends Controller
{
    public function __construct(protected InvestmentService $investmentService)
    {
    }

    public function userInvestments(): AnonymousResourceCollection
    {
        $userId = loggedInUserId();

        $investments = $this->investmentService->getInvestmentsByUserId($userId);

        return InvestmentsResource::collection($investments);
    }

    public function store(StoreInvestmentRequest $request): InvestmentsResource
    {
        $data = $request->validated();

        $userId = loggedInUserId();

        $createdInvestment = $this->investmentService->create($userId, $data);

        return new InvestmentsResource($createdInvestment);
    }

    public function update(UpdateInvestmentRequest $request, Investment $investment): Response
    {
        $data = $request->validated();

        $userId = loggedInUserId();

        $this->investmentService->update($userId, $investment->id, $data);

        return response()->noContent();
    }

    public function destroy(Investment $investment): Response
    {
        $userId = loggedInUserId();

        $this->investmentService->delete($userId, $investment->id);

        return response()->noContent();
    }
}
