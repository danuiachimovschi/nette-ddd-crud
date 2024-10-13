<?php

declare(strict_types=1);

namespace YourProjectName\UI\Sign;

use Nette;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;
use YourProjectName\Core\Domain\Exceptions\DuplicateNameException;
use YourProjectName\Core\Domain\Facades\UserFacade;
use YourProjectName\Core\Domain\Services\AuthService;
use Nette\Application\UI\Presenter;

final class SignPresenter extends Presenter
{
	#[Persistent]
	public string $backlink = '';

	public function __construct(
        private AuthService $authService,
        private UserFacade $userFacade,
	) {
	}

    public function actionOut(): void
	{
		$this->getUser()->logout();
	}

    protected function createComponentSignInForm(): Form
    {
        $this->authService->createSignInForm();
        $this->authService->signInFormBuilder->setOnSuccessAction($this->loginUser());

        return $this->authService->signInFormBuilder->getForm();
    }

    protected function createComponentSignUpForm(): Form
    {
        $this->authService->createSignUpForm();
        $this->authService->signUpFormBuilder->setOnSuccessAction($this->registerUser());

        return $this->authService->signUpFormBuilder->getForm();
    }

    private function loginUser(): callable
    {
        return function (Form $form, \stdClass $data): void {
            try {
                $this->getUser()->login($data->username, $data->password);
                $this->restoreRequest($this->backlink);
                $this->redirect('Dashboard:');
            } catch (Nette\Security\AuthenticationException) {
                $form->addError('The username or password you entered is incorrect.');
            }
        };
    }

    private function registerUser(): callable
    {
        return function (Form $form, \stdClass $data): void {
            try {
                $this->userFacade->add($data->username, $data->email, $data->password);
                $this->redirect('Dashboard:');
            } catch (DuplicateNameException) {
                $form['username']->addError('Username is already taken.'); // @phpstan-ignore-line
            }
        };
    }
}
