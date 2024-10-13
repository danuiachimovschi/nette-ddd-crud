<?php

declare(strict_types=1);

namespace YourProjectName\UI\Dashboard;

use Nette\Application\UI\Presenter;
use YourProjectName\Core\Domain\Middlewares\AuthMiddleware;

final class DashboardPresenter extends Presenter
{
	use AuthMiddleware;
}
