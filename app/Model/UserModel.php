<?php

declare(strict_types=1);

namespace App\Model;

use Core\DB;

class UserModel
{
    private static int $defaultFetchMode = \PDO::FETCH_CLASS;

    public static function getAuthorisedUser()
    {
        if (!isset($_SESSION['_token'])) {
            return false;
        }

        $user = static::getUserByToken($_SESSION['_token']);

        if ($user === null || $user->token !== $_SESSION['_token']) {
            return false;
        }

        $dateFormat = 'Y-m-d H:i:s';
        $tokenExpiresDate = \DateTime::createFromFormat($dateFormat, $user->token_expires);
        $currentDate = \DateTime::createFromFormat($dateFormat, date($dateFormat, time()));

        if ($tokenExpiresDate < $currentDate) {
            return false;
        }

        if ($user !== false) {
            return $user;
        }
    }

    public static function getUserByToken(string $token)
    {
        $user = DB::pdo()
            ->query("select * from users where token = '" . $token . "'")
            ->fetchAll(self::$defaultFetchMode);

        return $user[0] ?? null;
    }

    public static function getUserByEmail(string $email)
    {
        $user = DB::pdo()
            ->query("select * from users where email = '" . $email . "'")
            ->fetchAll(self::$defaultFetchMode);

        return $user[0] ?? null;
    }

    public static function setUserToken(int $userId, string $token)
    {
        $expiresDate = date('Y-m-d H:i:s', time()+86400);

        DB::pdo()
            ->prepare('update users set `token` = ?, `token_expires` = ? where id = ?')
            ->execute([$token, $expiresDate, $userId]);
    }

    public static function insertNewUser(string $email, string $password)
    {
        DB::pdo()
            ->prepare('insert into users (`email`, `password`) values (?, ?)')
            ->execute([$email, $password]);
    }
}