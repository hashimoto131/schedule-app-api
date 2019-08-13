<?php
namespace App\Helpers;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class JwtAuthHelper
{
    /**
     * [tokenの発行を行なう]
     * @return [string] [jwttoken]
     */
    public function tokenEncode($id, $loginId, $name)
    {
        $token = [
            'iss'  => config('app.url'),
            'aud'  => config('jwt.aud'),
            'exp'  => strtotime(config('jwt.sessionTime')),
            'id'   => $id,
            'login_id' => $loginId,
            'name' => $name,
        ];

        return JWT::encode($token, config('jwt.key'));
    }

    /**
     * [tokenのデコードを行なう]
     * @return [array] [jwtのデコード結果]
     */
    public function tokenDecode($token)
    {
        try {
            $tokenArr = explode(' ', $token);
            if (count($tokenArr) !== 2 || $tokenArr[0] !== 'Bearer')
                abort(401, config('error.auth.failedFormat'));

            $jwt = JWT::decode($tokenArr[1], config('jwt.key'), ['HS256']);
            return $jwt;
        } catch (ExpiredException $e) {
            abort(401, config('error.auth.expired'));
        } catch (Exception $e) {
            abort(401, config('error.auth.error'));
        }
    }
}
