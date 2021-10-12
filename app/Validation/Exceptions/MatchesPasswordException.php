<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MatchesPasswordException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => "The password doesn't match.",
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'The password matches.',
        ],
    ];
}