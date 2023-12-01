<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\PollModel;
use App\Model\UserModel;

class PollController
{
    public function webCreate()
    {
        if (!UserModel::getAuthorisedUser()) {
            echo 'not authorised.'; die;
        }

        require_once '../App/View/poll-create.php';
    }

    public function store()
    {
        $title = $_POST['title'];
        $status = $_POST['status'];
        $user = UserModel::getAuthorisedUser();

        $poll = PollModel::insertPoll($user->id, $title, $status);
        $option = null;

        $isSecondIteration = false;

        foreach ($_POST as $name => $value) {
            $isSecondIteration = ! $isSecondIteration;

            if ($isSecondIteration === true) {
                preg_match('/option(\d+)Votes/', $name, $votes);

                if(!empty($votes) && !is_null($option)) {
                    PollModel::insertPollVotes($option->id, (int) $value);
                }

                continue;
            }

            preg_match('/option(\d+)/', $name, $options);

            if(!empty($options)) {
                $option = PollModel::insertPollOption($poll->id, $value);
            }
        }

        echo 'successfully created.';
        echo '<br><a href="/">Back to Dashboard.</a>';
    }

    public function update()
    {

    }

    public function delete(int $id)
    {
        PollModel::deletePollById($id);

        echo 'successfully deleted.';
        echo '<br><a href="/">Back to Dashboard.</a>';
    }

    public function show()
    {
    }

    public function single(int $id)
    {
        var_dump($id);

    }
}