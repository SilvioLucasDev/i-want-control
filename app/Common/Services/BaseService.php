<?php declare(strict_types = 1);

namespace App\Common\Services;

use App\Common\Contracts\BaseRepositoryInterface;
use App\Common\Contracts\BaseServiceInterface;
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
     * @param int $id
     * @return T|null
     */
    public function find(int $id): ?Model
    {
        return $this->repository->find($id);
    }

    /**
     * Creates a new record.
     *
     * @param array<string, mixed> $data
     * @return T
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * Updates a record by its ID.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Deletes a record by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
