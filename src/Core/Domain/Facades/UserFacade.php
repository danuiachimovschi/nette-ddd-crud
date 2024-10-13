<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Facades;

use Nette\Database\Explorer;
use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Nette\Utils\Validators;
use Nette\Security\SimpleIdentity;
use YourProjectName\Core\Domain\Exceptions\DuplicateNameException;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Security\AuthenticationException;

final class UserFacade implements Authenticator
{
    public const PasswordMinLength = 7;

    private const
        TableName = 'users',
        ColumnId = 'id',
        ColumnName = 'username',
        ColumnPasswordHash = 'password',
        ColumnEmail = 'email',
        ColumnRole = 'role';

    public function __construct(
        private Explorer $database,
        private Passwords $passwords,
    ) {
    }

    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $row = $this->database->table(self::TableName)
            ->where(self::ColumnName, $username)
            ->fetch();

        if (!$row) {
            throw new AuthenticationException('The username is incorrect.', self::IdentityNotFound);

        } elseif (!$this->passwords->verify($password, $row[self::ColumnPasswordHash])) {
            throw new AuthenticationException('The password is incorrect.', self::InvalidCredential);

        } elseif ($this->passwords->needsRehash($row[self::ColumnPasswordHash])) {
            $row->update([
                self::ColumnPasswordHash => $this->passwords->hash($password),
            ]);
        }

        $arr = $row->toArray();
        unset($arr[self::ColumnPasswordHash]);
        return new SimpleIdentity($row[self::ColumnId], $row[self::ColumnRole], $arr);
    }

    public function add(string $username, string $email, string $password): void
    {
        Validators::assert($email, 'email');

        try {
            $this->database->table(self::TableName)->insert([
                self::ColumnName => $username,
                self::ColumnPasswordHash => $this->passwords->hash($password),
                self::ColumnEmail => $email,
            ]);
        } catch (UniqueConstraintViolationException $e) {
            throw new DuplicateNameException;
        }
    }
}
