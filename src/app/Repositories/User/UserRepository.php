<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    /**
    * UserRepository constructor.
    * @param $user
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * [会員の一覧取得]
     *
     * @return void
     */
    public function getAll()
    {
        return  $this->user->all();
    }

    /**
     * [会員の作成]
     *
     * @param [type] $params
     * @return void
     */
    public function create(array $params)
    {
        return  $this->user->create($params);
    }

    /**
     * [IDで検索して１件の結果を返す]
     *
     * @param integer $id
     * @return void
     */
    public function findById(int $id)
    {
        $res = $this->user->find($id);
        if (!$res) abort(404, config('error.users.notFound'));

        return $res;
    }

    /**
     * [ログインIDで検索して１件を返す]
     *
     * @param [type] $loginId
     * @return void
     */
    public function findByLoginId(string $loginId)
    {
        $res = $this->user->where('login_id', $loginId)->first();

        return $res;
    }

    /**
     * [単一ユーザーの更新]
     *
     * @param [type] $id
     * @param [type] $params
     * @return void
     */
    public function updateUser(array $params, int $id)
    {
        $user = $this->user->find($id);
        if (!$user) abort(404, config('error.users.notFound'));
        $user->update($params);

        return $user;
    }

    /**
     * [単一ユーザーの削除]
     *
     * @param [type] $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        $user = $this->user->find($id);
        if (!$user) abort(404, config('error.users.notFound'));

        return $user->delete();
    }
}
