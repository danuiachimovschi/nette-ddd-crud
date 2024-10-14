<?php

declare(strict_types=1);

namespace YourProjectName\UI\User;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use YourProjectName\Core\Domain\Exceptions\DuplicateNameException;
use YourProjectName\Core\Domain\Facades\UserFacade;
use YourProjectName\Core\Domain\Middlewares\AuthMiddleware;
use YourProjectName\Core\Domain\Repositories\UserRepository;
use YourProjectName\Core\Domain\Services\UserService;

class UserPresenter extends Presenter
{
    use AuthMiddleware;

    public function __construct(
        private UserRepository $repository,
        private UserService $userService,
        private UserFacade $userFacade,
    ){}

    public function actionIndex(): void
    {
        $users = $this->repository->fetchAll();

        $this->template->users = $users;
    }

    public function actionShow(int $id): void
    {
        $user = $this->repository->fetchById($id);

        if (!$user) {
            $this->flashMessage('This user does not exist', 'error');
            $this->redirect('User:index');
        }

        $this->template->userItem = $user;
    }

    public function actionEdit(int $id): void
    {
        $user = $this->repository->fetchById($id);

        if (!$user) {
            $this->flashMessage('This user does not exist', 'error');
            $this->redirect('User:index');
        }

        $this->template->userItem = $user;
    }

    public function actionDelete(int $id): void
    {
        $this->repository->delete($id);
        $this->redirect('User:index');
    }

    protected function createComponentEditUserForm(): Form
    {
        $this->userService->createEditUserForm();
        $this->userService->editUserFormBuilder->setOnSuccessAction($this->editUser());

        return $this->userService->editUserFormBuilder->getForm();
    }

    protected function createComponentCreateUserForm(): Form
    {
        $this->userService->createCreateUserForm();
        $this->userService->createUserFormBuilder->setOnSuccessAction($this->createUser());

        return $this->userService->createUserFormBuilder->getForm();
    }

    private function createUser(): callable
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

    private function editUser(): callable
    {
        return function (Form $form, \stdClass $data): void {
            try {
                $this->userFacade->edit($data->username, $data->email);
                $this->redirect('Dashboard:');
            } catch (DuplicateNameException) {
                $form['username']->addError('Username is already taken.'); // @phpstan-ignore-line
            }
        };
    }
}