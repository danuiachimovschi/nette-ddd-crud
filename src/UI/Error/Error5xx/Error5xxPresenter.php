<?php

declare(strict_types=1);

namespace YourProjectName\UI\Error\Error5xx;

use Nette\Application\Attributes\Requires;
use Nette\Application\Responses;
use Nette\Http;
use Tracy\ILogger;
use Nette\Application\IPresenter;
use Nette\Application\Request;
use Nette\Application\Response;

#[Requires(forward: true)]
final class Error5xxPresenter implements IPresenter
{
	public function __construct(
		private ILogger $logger,
	) {
	}

	public function run(Request $request): Response
	{
		$exception = $request->getParameter('exception');
		$this->logger->log($exception, ILogger::EXCEPTION);

		return new Responses\CallbackResponse(function (Http\IRequest $httpRequest, Http\IResponse $httpResponse): void {
			if (preg_match('#^text/html(?:;|$)#', (string) $httpResponse->getHeader('Content-Type'))) {
				require __DIR__ . '/500.phtml';
			}
		});
	}
}
