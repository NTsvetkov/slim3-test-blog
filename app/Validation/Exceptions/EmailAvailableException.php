<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'There is already registered user with this email. Please, use another.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Email ia available for registration.',
        ],
    ];
}