<?php declare(strict_types = 1);

namespace App\Expense\Services;

use App\Common\Services\BaseService;
use App\Expense\Models\PaymentMethod;
use App\Expense\Repositories\PaymentMethodRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseService<PaymentMethod, PaymentMethodRepository>
 */
class PaymentMethodService extends BaseService
{
    public function __construct(PaymentMethodRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): Model
    {
        $data['name']    = $data['type'];
        $data["user_id"] = auth()->id();
        unset($data['type']);

        return $this->repository->create($data);
    }

    /**
     * @return Collection<int, PaymentMethod>
     */
    public function userPaymentMethods(): Collection
    {

        return $this->repository
            ->userPaymentMethods(auth()->id());
    }
}
