<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Services;

use Nette\Application\UI\Form;
use YourProjectName\Core\Domain\Builders\SignInFormBuilder;
use YourProjectName\Core\Domain\Builders\SignUpFormBuilder;

class AuthService
{
    public function __construct(
        public readonly SignInFormBuilder $signInFormBuilder,
        public readonly SignUpFormBuilder $signUpFormBuilder,
    ) {}

    public function createSignInForm(): Form
    {
        return $this->signInFormBuilder->makeForm();
    }

    public function createSignUpForm(): Form
    {
        return $this->signUpFormBuilder->makeForm();
    }
}