<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\UserValidator;
use Exception;

use App\Models\User;
use App\Traits\RestExceptionHandlerTrait;
use App\Traits\RestTrait;

use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use JWTAuth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiAuthController extends ApiController
{

    use RestTrait;
    use RestExceptionHandlerTrait;

    private $validatorObj;

    public function __construct(UserValidator $validator)
    {
        $this->user = new User;
        $this->validatorObj = $validator;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $this->validatorObj->validateLogin($credentials);
        $token = JWTAuth::attempt($credentials);

        try {
            if (!$token) {
                return $this->jsonResponse(['error' => USER_INVALID], CODE_UNAUTHENTICATED);
            }
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => TOKEN_FAILED], CODE_BAD_REQUEST);
        }

        $user = $this->user->getUserByEmail($credentials['email']);

        return $this->jsonResponse([
            'data' => $user,
            'status' => STATUS_SUCCESS,
            'message' => LOGIN_SUCCESS,
            'token' => $token,
        ], CODE_OK);

    }

    public function getAuthUser()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                throw new Exception('Token not provided', 500);
            }
            $user = JWTAuth::toUser($token);
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], CODE_SERVER_ERROR);
        }
        return $this->jsonResponse(['user' => $user], 200);
    }

    public function token()
    {
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                throw new Exception('Token not provided', 500);
            }
            $token = JWTAuth::refresh($token);
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], CODE_SERVER_ERROR);
        }
        return $this->jsonResponse(['token' => $token], 200);
        //return $this->response->withArray(['token' => $token]);
    }

}
