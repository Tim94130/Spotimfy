<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddUniqueIndexToUsersUsername extends AbstractMigration
{
    public function change(): void
    {
        $this->table('users')
            ->addIndex(['username'], ['unique' => true, 'name' => 'UNIQUE_USERNAME'])
            ->update();
    }
}
