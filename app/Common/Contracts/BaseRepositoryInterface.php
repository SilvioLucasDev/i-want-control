<?php

declare(strict_types = 1);

namespace App\Common\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface BaseRepositoryInterface
{
    /**
     * Returns all records.
     *
     * @return Collection<int, T>
     */
    public function all(): Collection;

    /**
     * Returns a record by its ID.
     *
     * @param int $id
     * @return T|null
     */
    public function find(int $id): ?Model;

    /**
     * Creates a new record.
     *
     * @param array<string, mixed> $data
     * @return T
     */
    public function create(array $data): Model;

    /**
     * Updates a record by its ID.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Deletes a record by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
