<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Factories;

use Nette\Application\UI\Form;
use Nette\Security\User;

final class FormFactory
{
    public function create(): Form
    {
        $form = new Form;

        $form->addProtection('Security token has expired, please submit the form again.');

        return $form;
    }
}


