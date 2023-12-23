<?php

namespace Framework\Console\Commands;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Framework\Console\CommandInterface;

class MigrateCommand implements CommandInterface
{
    private string $name = 'migrate';
    private const MIGRATIONS_TABLE = 'migrations';
    public function __construct(
        private Connection $connection
    )
    {
    }

    public function execute(array $parameters = []): int
    {
        try {
            $this->createMigrationsTable();

            $this->connection->beginTransaction();

            $appliedMigrations = $this->getAppliedMigrations();

            dd($appliedMigrations);

            $this->connection->commit();
        }catch (\Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }


        //$this->createmigrationsTable();

        return 0;
    }
    private function createMigrationsTable(): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(self::MIGRATIONS_TABLE)) {
            $schema = new Schema();
            $table = $schema->createTable(self::MIGRATIONS_TABLE);
            $table->addColumn('id', Types::INTEGER, [
                'unsigned' => true,
                'autoincrement' => true
            ]);
            $table->addColumn('migration', Types::STRING);
            $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, [
                'default' => 'CURRENT_TIMESTAMP'
            ]);
            $table->setPrimaryKey(['id']);
            $sqlArray = $schema->toSql($this->connection->getDatabasePlatform());
            $this->connection->executeQuery($sqlArray[0]);
            echo 'Table migrations has been created' . PHP_EOL;
        }
    }
    private function getAppliedMigrations()
    {
        $queryBuilder =  $this->connection->createQueryBuilder();

        return $queryBuilder
             ->select('migration')
             ->from(self::MIGRATIONS_TABLE)
             ->executeQuery()
             ->fetchFirstColumn();



    }
}