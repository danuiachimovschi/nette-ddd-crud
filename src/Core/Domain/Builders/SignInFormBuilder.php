<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Builders;

use Nette\Application\UI\Form;
use YourProjectName\Core\Domain\Factories\FormFactory;

final class SignInFormBuilder extends AbstractFormBuilder
{
    public function __construct(
        private readonly FormFactory $formFactory,
    ){}

    public function makeForm(): Form
    {
        $this->form = $this->formFactory->create();
        $this->setValidations();

        $this->form->addSubmit('send', 'Sign in');

        return $this->form;
    }

    private function setValidations(): void
    {
        $this->form->addText('username', 'Username:')
            ->setRequired('Please enter your username.');

        $this->form->addPassword('password', 'Password:')
            ->setRequired('Please enter your password.');
    }
}