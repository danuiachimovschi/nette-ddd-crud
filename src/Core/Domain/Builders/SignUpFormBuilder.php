<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Builders;

use Nette\Application\UI\Form;
use YourProjectName\Core\Domain\Facades\UserFacade;
use YourProjectName\Core\Domain\Factories\FormFactory;

final class SignUpFormBuilder extends AbstractSignFormBuilder
{
    public function __construct(
        private readonly FormFactory $formFactory,
    ){}

    public function makeForm(): Form
    {
        $this->form = $this->formFactory->create();
        $this->setValidations();

        $this->form->addSubmit('send', 'Sign up');

        return $this->form;
    }

    private function setValidations(): void
    {
        $this->form->addText('username', 'Pick a username:')
            ->setRequired('Please pick a username.');

        $this->form->addEmail('email', 'Your e-mail:')
            ->setRequired('Please enter your e-mail.');

        $this->form->addPassword('password', 'Create a password:')
            ->setOption('description', sprintf('at least %d characters', UserFacade::PasswordMinLength))
            ->setRequired('Please create a password.')
            ->addRule($this->form::MinLength, null, UserFacade::PasswordMinLength);
    }
}