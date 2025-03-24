<?php declare(strict_types = 1);

namespace App\Expense\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Expense\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<PaymentMethod>
 */
class PaymentMethodRepository extends BaseRepository
{
    public function __construct(protected PaymentMethod $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return Collection<int, PaymentMethod>
     */
    public function getPaymentMethodsByUserId(int $userId): Collection
    {
        return $this->repository
            ->query()
            ->where("user_id", $userId)
            ->get();
    }
}
