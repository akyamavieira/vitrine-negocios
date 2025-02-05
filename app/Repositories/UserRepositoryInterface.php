<?php

namespace App\Repositories;
use App\DTO\UserDTO;

interface UserRepositoryInterface
{
    public function all();
    public function findOrFail($id);
    public function create(UserDTO $userDTO);
    public function update($id, UserDTO $userDTO);
    public function delete($id);
}