<?php

declare(strict_types=1);

namespace Core;

use PDO;

class DB
{
    protected static PDO $pdo;

    protected static string $table = '';
    protected static string $where = '';

    public static function boot()
    {
        $connector = new Connector('mysql');

        static::$pdo = $connector
            ->withHost(DB_HOST)
            ->withPassword(DB_PASSWORD)
            ->withUser(DB_USER)
            ->withDatabase(DB_DATABASE)
            ->withPort('3306')
            ->get();

        static::migrate();
    }

    public static function migrate()
    {
        $migrations = scandir('../migrations');

        unset($migrations[0]);
        unset($migrations[1]);

        foreach ($migrations as $file) {
            $migrationFile = file_get_contents('../migrations/' . $file);

            DB::pdo()->query($migrationFile);
        }
    }

    public static function pdo()
    {
        return static::$pdo;
    }
}