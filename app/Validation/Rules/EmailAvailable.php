<?php

namespace App\Validation\Rules;

use Doctrine\ORM\EntityManager;
use Respect\Validation\Rules\AbstractRule;
use App\Entity\User;

final class EmailAvailable extends AbstractRule
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($input): bool
    {
        $return = $this->em->getRepository(User::class)->findOneBy([
            'email' => $input,
        ]) ? false : true;

        return $return;
    }
}