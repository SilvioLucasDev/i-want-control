<?php declare(strict_types = 1);

namespace App\User\Repositories;

use App\Common\Repositories\BaseRepository;
use App\User\Models\User;

/**
 * @extends BaseRepository<User>
 */
class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
