<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Factories;

use Nette\Application\UI\Form;
use Nette\Security\User;

final class FormFactory
{
    public function __construct(
        private User $user,
    ) {
    }

    public function create(): Form
    {
        $form = new Form;
        if ($this->user->isLoggedIn()) {
            $form->addProtection();
        }

        return $form;
    }
}


