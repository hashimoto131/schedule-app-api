<?php
namespace App\Services\User;

interface UserServiceInterface
{
    public function index();
    public function store(object $request);
    public function show(int $id);
    public function update(object $request, int $id);
    public function checkPass(object $request, int $id);
    public function login(object $request);
}
