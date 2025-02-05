<?php
namespace App\Repositories;

use App\Models\User;
use App\DTO\UserDTO;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function findOrFail($id)
    {
        if (!Str::isUuid($id)) {
            throw new \InvalidArgumentException("Invalid UUID: $id");
        }
        return User::findOrFail($id);
    }

    public function create(UserDTO $userDTO)
    {
        $user = new User();
        $user->id = $userDTO->id;
        $user->nickname = $userDTO->nickname;
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        $user->save();

        return $user;
    }

    public function update($id, UserDTO $userDTO)
    {
        $user = User::findOrFail($id);
        $user->nickname = $userDTO->nickname;
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}