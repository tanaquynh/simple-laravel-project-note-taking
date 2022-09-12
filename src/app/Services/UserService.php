<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\UserRepository;

class UserService
{
	protected $userRepository;
    protected $authService;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function create(array $data) {
        return $this->userRepository->create($data);
    }

}