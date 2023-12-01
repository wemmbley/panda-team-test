<?php

declare(strict_types=1);

namespace App\Model;

use Core\DB;

class PollModel
{
    public static function insertPoll(int $userId, string $title, string $status)
    {
        $pdo = DB::pdo();

        $pdo->prepare('insert into polls (`user_id`,`title`,`status`) values (?,?,?)')
            ->execute([$userId, $title, $status]);

        $id = $pdo->lastInsertId();

        return static::getPollById($id);
    }

    public static function getPollById(string $id)
    {
        $query = DB::pdo()->query('select * from polls where id=' . $id);

        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public static function getPollOptionById(string $id)
    {
        $query = DB::pdo()->query('select * from poll_options where id=' . $id);

        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public static function insertPollOption(int $pollId, string $option)
    {
        $pdo = DB::pdo();

        $pdo->prepare('insert into poll_options (`poll_id`,`name`) values (?,?)')
            ->execute([$pollId, $option]);

        $id = $pdo->lastInsertId();

        return static::getPollOptionById($id);
    }

    public static function insertPollVotes(int $optionId, int $votes)
    {
        DB::pdo()
            ->prepare('insert into poll_votes (`option_id`,`votes`) values (?,?)')
            ->execute([$optionId, $votes]);
    }

    public static function getAllPollsByAuthUser()
    {
        $user = UserModel::getAuthorisedUser();

        $polls = DB::pdo()->query('select * from polls where user_id=' . $user->id);

        return $polls->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function deletePollById(int $id)
    {
        var_dump($id);
        DB::pdo()
            ->prepare('delete from polls where id=?')
            ->execute([$id]);
    }
}