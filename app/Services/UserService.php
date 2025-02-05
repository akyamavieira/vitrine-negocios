<?php

namespace App\Services;
use App\DTO\UserDTO;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUserFromDTO(UserDTO $userDTO)
    {
        return $this->userRepository->create($userDTO);
    }

    public function findUserById($id)
    {
        return $this->userRepository->findOrFail($id);
    }
}
