<?php

declare(strict_types=1);

namespace YourProjectName\Core\Application\Commands;

use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use YourProjectName\Bootstrap;
use YourProjectName\Core\Domain\Facades\UserFacade;

#[AsCommand(name: 'user:create', description: 'Create a new user')]
class CreateUserCommand extends Command
{
    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, "name of user")
            ->addArgument('email', InputArgument::REQUIRED, "email address of user")
            ->addArgument('password', InputArgument::REQUIRED, "password of user");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $container = Bootstrap::boot()
            ->createContainer();

        $userManager = $container->getByType(UserFacade::class);

        try {
            $userManager->add($input->getArgument('name'), $input->getArgument('email'), $input->getArgument('password'));

            $output->writeln("User created successfully");
        } catch (Exception) {
            $output->writeln("Create user failed");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}