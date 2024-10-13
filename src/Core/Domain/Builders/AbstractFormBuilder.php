<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Builders;

use Nette\Application\UI\Form;

abstract class AbstractFormBuilder
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