<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Expense\Http\Requests\StorePaymentMethodRequest;
use App\Expense\Http\Requests\UpdatePaymentMethodRequest;
use App\Expense\Http\Resources\PaymentMethodResource;
use App\Expense\Models\PaymentMethod;
use App\Expense\Services\PaymentMethodService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PaymentMethodController extends Controller
{
    public function __construct(protected PaymentMethodService $paymentMethodService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $userId = loggedInUserId();

        $paymentMethods = $this->paymentMethodService->getPaymentMethodsByUserId($userId);

        return PaymentMethodResource::collection($paymentMethods);
    }

    public function store(StorePaymentMethodRequest $request): PaymentMethodResource
    {
        $data = $request->validated();

        $userId = loggedInUserId();

        $createdPaymentMethod = $this->paymentMethodService->create($userId, $data);

        return new PaymentMethodResource($createdPaymentMethod);
    }

    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod): Response
    {
        $data = $request->validated();

        $userId = loggedInUserId();

        $this->paymentMethodService->update($userId, $paymentMethod->id, $data);

        return response()->noContent();
    }

    public function destroy(PaymentMethod $paymentMethod): Response
    {
        $userId = loggedInUserId();

        $this->paymentMethodService->delete($userId, $paymentMethod->id);

        return response()->noContent();
    }
}
