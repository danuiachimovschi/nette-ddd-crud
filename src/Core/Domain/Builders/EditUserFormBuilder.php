<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Builders;

use Nette\Application\UI\Form;
use YourProjectName\Core\Domain\Factories\FormFactory;

class EditUserFormBuilder extends AbstractFormBuilder
{
    public function __construct(
        private readonly FormFactory $formFactory,
    ){}

    public function makeForm(): Form
    {
        $this->form = $this->formFactory->create();
        $this->setValidations();

        $this->form->addSubmit('send', 'Edit user');

        return $this->form;
    }

    private function setValidations(): void
    {
        $this->form->addText('username', 'Username:')
            ->setRequired('Please enter a username.');

        $this->form->addText('email', 'Email:')
            ->setRequired('Please enter an email.')
            ->addRule(Form::EMAIL, 'Please enter a valid email address.');
    }
}