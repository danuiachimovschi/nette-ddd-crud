<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Services;

use Nette\Application\UI\Form;
use YourProjectName\Core\Domain\Builders\CreateUserFormBuilder;
use YourProjectName\Core\Domain\Builders\EditUserFormBuilder;

class UserService
{
    public function __construct(
        public readonly EditUserFormBuilder $editUserFormBuilder,
        public readonly CreateUserFormBuilder $createUserFormBuilder,
    ){}

    public function createEditUserForm(): Form
    {
        return $this->editUserFormBuilder->makeForm();
    }

    public function createCreateUserForm(): Form
    {
        return $this->createUserFormBuilder->makeForm();
    }
}