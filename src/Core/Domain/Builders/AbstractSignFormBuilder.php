<?php

namespace YourProjectName\Core\Domain\Builders;

use Nette\Application\UI\Form;

abstract class AbstractSignFormBuilder
{
    protected Form $form;

    public function getForm(): Form
    {
        return $this->form;
    }

    public function setOnSuccessAction(callable $onSuccess): void
    {
        $this->form->onSuccess[] = $onSuccess;
    }
}