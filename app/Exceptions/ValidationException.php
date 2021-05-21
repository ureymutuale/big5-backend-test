<?php


namespace App\Exceptions;


use Exception;
use Throwable;

class ValidationException extends Exception
{

    public $errors;

    public function __construct($message = "", $code = 0, Throwable $previous = null, $errors = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * Gets the error list of validation errors.
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Sets the error list of validation errors.
     * @param null $errors
     */
    public function setErrors($errors = null)
    {
        $this->errors = $errors;
    }

}

