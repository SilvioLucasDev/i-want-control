<?php declare(strict_types = 1);

namespace App\Common\Services;

use App\Common\Repositories\Interfaces\BaseRepositoryInterface;
use App\Common\Services\Interfaces\BaseServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 * @template R of BaseRepositoryInterface<T>
 * @implements BaseServiceInterface<T>
 */
abstract class BaseService implements BaseServiceInterface
{
    /**
     * @param R $repository
     */
    public function __construct(protected BaseRepositoryInterface $repository)
    {
    }

    /**
     * Returns all records.
     *
     * @return Collection<int, T>
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * Returns a record by its ID.
     *
     * @return T|null
     */
    public function find(int $id): ?Model
    {
        return $this->repository->find($id);
    }
}
