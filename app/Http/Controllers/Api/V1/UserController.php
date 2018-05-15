<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\UserValidator;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;
use App\Traits\RestTrait;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class UserController extends ApiController
{

    use RestTrait;
    use RestExceptionHandlerTrait;

    private $userObj;
    private $profileObj;
    private $validatorObj;

    public function __construct(User $user, Profile $profile, UserValidator $validator)
    {
        $this->userObj = $user;
        $this->profileObj = $profile;
        $this->validatorObj = $validator;
    }

    /**
     * @return UserCollection|string
     */
    public function index()
    {
        try {
            $users = $this->userObj->getUsersWithProfile();

            if (!$users) {
                throw new Exception(USERS_NOT_FOUND, CODE_NOT_FOUND);
            }

            $collection = new UserCollection($users, CODE_OK, STATUS_SUCCESS);
            return $collection;
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->jsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function getProfile($userId)
    {
        try {
            $profile = $this->userObj->getProfile($userId);

            if (!$profile) {
                throw new Exception(USER_PROFILE_NOT_FOUND, CODE_NOT_FOUND);
            }

            return new UserResource($profile, NO_MESSAGE, STATUS_SUCCESS, null);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->jsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function register(Request $request)
    {
        try {

            DB::beginTransaction();

            $data = $request->all();
            $credentials = $request->only(['email', 'password']);
            $profileData = $request->only(['full_name','birthdate']);

            $validator = $this->validatorObj->validateRegister($data);

            if($validator->fails()){
                return $this->validationErrorResponse($validator->errors(), CODE_BAD_REQUEST);
            }

            $user = $this->userObj->create($credentials);
            if (!$user) {
                throw new Exception(USER_NOT_SAVED, CODE_SERVER_ERROR);
            }

            $profile = $this->profileObj->create($profileData);
            if(!$profile){
                throw new Exception(USER_NOT_SAVED, CODE_BAD_REQUEST);
            }

            $user->profile()->save($profile);

            $token = JWTAuth::attempt($credentials);

            logger()->info(" EMAIL ".$request->email." TOKEN ".$token);

            DB::commit();

            return new UserResource($user, USER_SAVED, STATUS_SUCCESS, $token);

        } catch (Exception $e) {
            logger()->error($e->getMessage());
            DB::rollback();
            return $this->jsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($userId)
    {
        try {
            $user = $this->userObj->find($userId);

            if (!$user) {
                throw new Exception(USER_PROFILE_NOT_FOUND, CODE_NOT_FOUND);
            }

            return new UserResource($user, NO_MESSAGE, STATUS_SUCCESS, null);

        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->jsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(Request $request, $userId)
    {
        try {
            $data = $request->only(['full_name','birthdate']);

            $user = $this->userObj->getProfile($userId);

            if (!$user) {
                throw new Exception(USER_PROFILE_NOT_FOUND, CODE_NOT_FOUND);
            }

            if (!$user->profile()->update($data)) {
                throw new Exception(USER_NOT_UPDATED, CODE_SERVER_ERROR);
            }

            return new UserResource($user, USER_UPDATED, STATUS_SUCCESS, null);

        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->jsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroy($userId)
    {
        //
    }
}
