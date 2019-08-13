<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getAll();

    public function create(array $params);

    public function findById(int $id);

    public function findByLoginId(string $loginId);

    public function updateUser(array $params, int $id);

    public function deleteUser(int $id);
}
