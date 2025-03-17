<?php declare(strict_types = 1);

namespace App\Expense\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Expense\Models\Investment;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<Investment>
 */
class InvestmentRepository extends BaseRepository
{
    public function __construct(protected Investment $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return Collection<int, Investment>
     */
    public function getInvestmentsByUserId(int $userId): Collection
    {
        return $this->repository
            ->query()
            ->where("user_id", $userId)
            ->get();
    }
}
