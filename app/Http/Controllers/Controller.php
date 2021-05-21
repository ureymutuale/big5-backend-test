<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $validator; # The validator instance. Will be initialized upon validation.


    protected function validateRequest($request, $rules = [])
    {
        $this->validator = Validator::make($request->all(), $rules);
        if ($this->validator->fails()) {
            throw new ValidationException(
                'Failed to pass validation.',
                400,
                null,
                $this->validator->errors()
            );
        }
    }
}
