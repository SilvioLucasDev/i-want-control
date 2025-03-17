<?php declare(strict_types = 1);

namespace App\Expense\Services;

use App\Common\Services\BaseService;
use App\Expense\Models\PaymentMethod;
use App\Expense\Repositories\PaymentMethodRepository;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * @return Collection<int, PaymentMethod>
     */
    public function getPaymentMethodsByUserId(int $userId): Collection
    {
        return $this->repository->getPaymentMethodsByUserId($userId);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(int $userId, array $data): Model
    {
        $data["user_id"] = $userId;

        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(int $userId, int $paymentMethodId, array $data): void
    {
        $paymentMethod = $this->repository->find($paymentMethodId);

        if ($userId !== $paymentMethod->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        $this->repository->update($paymentMethodId, $data);
    }

    public function delete(int $userId, int $paymentMethodId): void
    {
        $paymentMethod = $this->repository->find($paymentMethodId);

        if ($userId !== $paymentMethod->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        $this->repository->delete($paymentMethodId);
    }
}
