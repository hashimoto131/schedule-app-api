<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\User\UserServiceInterface;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * [ユーザーの全件取得]
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = $this->userService->index();

        return response()->json($res);
    }

    /**
     * [ユーザーの新規作成]
     *
     * @param UserRequest $request
     * @return void
     */
    public function store(UserRequest $request)
    {
        $res = $this->userService->store($request);

        return response()->json($res);
    }

    /**
     * [ユーザーの詳細取得]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $res = $this->userService->show($id);

        return response()->json($res);
    }

    /**
     * [ユーザーの更新]
     *
     * @param UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, int $id)
    {
        $res = $this->userService->update($request, $id);

        return response()->json($res);
    }

    /**
     * [ユーザーの削除]
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $res = $this->userService->destroy($id);

        return response()->json($res);
    }

    /**
     * [現在のパスワードチェック]
     *
     * @param Request $request
     * @param [type] $id
     * @return boolean
     */
    public function checkPass(UserRequest $request, int $id)
    {
        $res = $this->userService->checkPass($request, $id);

        return response()->json($res);
    }
}
