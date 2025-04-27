<?php declare(strict_types = 1);

namespace App\User\Services;

use App\Common\Services\BaseService;
use App\User\Models\User;
use App\User\Repositories\UserRepository;

/**
 * @extends BaseService<User, UserRepository>
 */
class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
