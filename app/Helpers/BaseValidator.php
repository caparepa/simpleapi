<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 1/27/2018
 * Time: 6:20 PM
 */

namespace App\Helpers;

use Validator;

use App\Traits\RestExceptionHandlerTrait;
use App\Traits\RestTrait;

class BaseValidator
{
    use RestTrait;
    use RestExceptionHandlerTrait;

    public function dataValidator($data, $rules, $messages)
    {
        return Validator::make($data, $rules, $messages);
    }

}