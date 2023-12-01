<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Dashboard.</h2>
    <a href="/poll/create">
        <button>Create new poll</button>
    </a>
    <p>Polls</p>
    <table>
        <tr>
            <th>Poll name</th>
            <th>Actions</th>
        </tr>
            <?php
            $allPolls = \App\Model\PollModel::getAllPollsByAuthUser();

            if($allPolls !== false) {
                foreach ($allPolls as $poll) {
                    echo '<tr>';
                    echo '<td>' . $poll->title . '</td>';
                    echo '<td><a href="/poll/edit/' . $poll->id . '">Edit</a>';
                    echo '<a href="/poll/delete/' . $poll->id . '">Delete</a></td>';
                    echo '</tr>';
                }
            }
            ?>
    </table>
</body>
</html>