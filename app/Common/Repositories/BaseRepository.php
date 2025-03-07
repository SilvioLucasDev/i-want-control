<?php

declare(strict_types = 1);

namespace App\Common\Repositories;

use App\Common\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 * @implements BaseRepositoryInterface<T>
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * Generic constructor receiving the Model.
     *
     * @param T $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * Returns all records.
     *
     * @return Collection<int, T>
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Returns a record by its ID.
     *
     * @return T|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Creates a new record.
     *
     * @param array<string, mixed> $data
     * @return T
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Updates a record by its ID.
     *
     * @param array<string, mixed> $data
     */
    public function update(int $id, array $data): bool
    {
        $record = $this->find($id);
        if (!$record instanceof Model) {
            return false;
        }

        return $record->update($data);
    }

    /**
     * Deletes a record by its ID.
     */
    public function delete(int $id): bool
    {
        $record = $this->find($id);
        if (!$record instanceof Model) {
            return false;
        }

        return $record->delete();
    }

    /**
     * Returns a Query Builder for the Model.
     *
     * @return Builder<T>
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }
}
