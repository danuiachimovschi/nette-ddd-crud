<?php

declare(strict_types=1);

namespace YourProjectName\UI\Error\Error4xx;

use Nette\Application\BadRequestException;
use Nette\Application\Attributes\Requires;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Template;

#[Requires(methods: '*', forward: true)]
final class Error4xxPresenter extends Presenter
{
    public Template $template;
	public function renderDefault(BadRequestException $exception): void
	{
		$code = $exception->getCode();
		$file = is_file($file = __DIR__ . "/$code.latte")
			? $file
			: __DIR__ . '/4xx.latte';

		$this->template->httpCode = $code; // @phpstan-ignore-line
		$this->template->setFile($file);
	}
}
