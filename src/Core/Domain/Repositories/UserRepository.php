<?php

declare(strict_types=1);

namespace YourProjectName\Core\Domain\Repositories;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

class UserRepository
{
    public function __construct(
        private Explorer $database,
    ){}

    /**
     * @return Selection<ActiveRow>
     */
    public function fetchAll(): Selection
    {
        return $this->database->table('users')->select('id, username, email, role');
    }

    public function fetchById(int $id): ?ActiveRow
    {
        return $this->database->table('users')->get($id);
    }

    public function delete(int $id): void
    {
        $this->database->table('users')->get($id)->delete();
    }
}