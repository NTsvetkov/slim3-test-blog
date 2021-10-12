<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Entity\User;

final class MatchesPassword extends AbstractRule
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function validate($input): bool
    {
        return password_verify($input, $this->user->getPassword());
    }
}