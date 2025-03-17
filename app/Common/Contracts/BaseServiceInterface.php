<?php declare(strict_types = 1);

namespace App\Common\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface BaseServiceInterface
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
     * @return T|null
     */
    public function find(int $id): ?Model;
}
