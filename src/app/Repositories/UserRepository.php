<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Exception;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    public function getModel()
    {
        //return YourModel::class;
        return User::class;
    }

    public function getByUserIdFirstOrFail($userid) {
        try {
            return $this->model->where('userid', $userid)->firstOrFail();
        }
        catch (Exception $e) {
            throw new ModelNotFoundException($this->msgNotFound, 0);
        }
    }

    public function getByUserId($userid) {
        return $this->model->where('userid', $userid)->first();
    }
}
