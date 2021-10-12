<?php

namespace App\Validation\Rules;

use Doctrine\ORM\EntityManager;
use Respect\Validation\Rules\AbstractRule;
use App\Entity\User;

final class UsernameAvailable extends AbstractRule
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($input): bool
    {
        $return = $this->em->getRepository(User::class)->findOneBy([
            'username' => $input,
        ]) ? false : true;

        return $return;
    }
}