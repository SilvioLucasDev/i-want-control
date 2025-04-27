<?php declare(strict_types = 1);

namespace App\Expense\Services;

use App\Common\Services\BaseService;
use App\Expense\Models\Investment;
use App\Expense\Repositories\InvestmentRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseService<Investment, InvestmentRepository>
 */
class InvestmentService extends BaseService
{
    public function __construct(InvestmentRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return Collection<int, Investment>
     */
    public function getInvestmentsByUserId(int $userId): Collection
    {
        return $this->repository->getInvestmentsByUserId($userId);
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
