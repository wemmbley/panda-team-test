<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poll create</title>
</head>
<body>
<form action="/poll/create" method="post">
    <label>
        Title
        <input type="text" name="title">
    </label>
    <br>
    <div id="options">
        <label>
            Option 1
            <input type="text" name="option1">
        </label>
        <br>
        <label>
            Option 1 Votes
            <input type="text" name="option1Votes">
        </label>
        <br>
        <label>
            Option 2
            <input type="text" name="option2">
        </label>
        <br>
        <label>
            Option 2 Votes
            <input type="text" name="option2Votes">
        </label>
        <br>
    </div>
    <input type="button" id="addOption" value="Add option">
    <br>
    <label>
        Status
        <br>
        <label>
            Published
            <input type="radio" name="status" value="published" checked>
        </label>
        <label>
            Draft
            <input type="radio" name="status" value="draft">
        </label>
    </label>
    <input type="submit" id="addOption" value="Send">
</form>
</body>
</html>

<script>
    const button = document.querySelector('#addOption');
    const options = document.querySelector('#options');

    let optionsCount = 2;

    button.addEventListener('click', function (e) {
        optionsCount++;

        options.innerHTML += `
        <label>
            Option ${optionsCount}
            <input type="text" name="option${optionsCount}">
        </label>
        <br>
        <label>
            Option ${optionsCount} Votes
            <input type="text" name="option${optionsCount}Votes">
        </label>
        <br>
        `;
    });
</script>