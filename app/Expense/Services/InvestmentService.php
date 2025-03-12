<?php declare(strict_types = 1);

namespace App\Expense\Services;

use App\Common\Services\BaseService;
use App\Expense\Models\Investment;
use App\Expense\Repositories\InvestmentRepository;
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

    public function create(array $data): Model
    {
        $data['name']    = $data['type'];
        $data["user_id"] = auth()->id();
        unset($data['type']);

        return $this->repository->create($data);
    }

    /**
     * @return Collection<int, Investment>
     */
    public function userInvestments(): Collection
    {
        return $this->repository
            ->userInvestments(auth()->id());
    }
}
