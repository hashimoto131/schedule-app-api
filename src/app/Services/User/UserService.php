<?php
namespace App\Services\User;

use Hash;
use JwtAuth;
use App\Services\User\UserServiceInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * [ユーザーの全件取得]
     *
     * @return void
     */
    public function index()
    {
        return $this->userRepository->getAll();
    }

    /**
     * [ユーザーの新規作成]
     *
     * @param object $request
     * @return void
     */
    public function store(object $request)
    {
        $params = $request->only([
            'name',
            'login_id',
            'password',
        ]);
        $params['password'] = bcrypt($params['password']);

        return $this->userRepository->create($params);
    }

    /**
     * [ユーザーの詳細取得]
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        return $this->userRepository->findById($id);
    }

    /**
     * [ユーザーの更新]
     *
     * @param object $request
     * @param integer $id
     * @return void
     */
    public function update(object $request, int $id)
    {
        $params = $request->only([
            'login_id',
            'password',
        ]);
        if (isset($params['password'])) {
            $params['password'] = bcrypt($params['password']);
        }

        return $this->userRepository->updateUser($params, $id);
    }

    /**
     * [ユーザーの削除]
     *
     * @param [type] $id
     * @return void
     */
    public function destroy(int $id)
    {
        return $this->userRepository->deleteUser($id);
    }


    /**
     * [現在のパスワードチェック]
     *
     * @param object $request
     * @param integer $id
     * @return void
     */
    public function checkPass(object $request, int $id)
    {
        $inputPass = $request->input('password');
        $user = $this->userRepository->findById($id);
        if (!$user) abort(404, config('error.users.notFound'));

        return Hash::check($inputPass, $user->password);
    }

    /**
     * [ログイン認証]
     *
     * @param object $request
     * @return void
     */
    public function login(object $request)
    {
        $params = $request->only('login_id', 'password');
        $user   = $this->userRepository->findByLoginId($params['login_id']);
        if (!$user || !Hash::check($params['password'], $user->password))
            abort(401, config('error.auth.failedLogin'));
        return JwtAuth::tokenEncode($user->id, $user->login_id, $user->name);
    }
}
