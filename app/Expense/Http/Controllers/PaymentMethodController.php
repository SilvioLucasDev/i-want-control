<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Expense\Http\Requests\StorePaymentMethodRequest;
use App\Expense\Http\Requests\UpdatePaymentMethodRequest;
use App\Expense\Http\Resources\PaymentMethodResource;
use App\Expense\Models\PaymentMethod;
use App\Expense\Services\PaymentMethodService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentMethodController extends Controller
{
    public function __construct(protected PaymentMethodService $paymentMethodService)
    {
    }

    public function userPaymentMethods(): AnonymousResourceCollection
    {
        $paymentMethods = $this->paymentMethodService
            ->userPaymentMethods();

        return PaymentMethodResource::collection($paymentMethods);
    }

    public function store(StorePaymentMethodRequest $request): void
    {
        $this->paymentMethodService
            ->create($request->validated());
    }

    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod): void
    {
        $this->paymentMethodService
            ->update(
                $paymentMethod->id,
                $request->validated()
            );
    }

    public function destroy(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethodService->delete($paymentMethod->id);
    }
}
