<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class UsernameAvailableException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'There is already registered user with this username. Please, use another.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Username ia available for registration.',
        ],
    ];
}