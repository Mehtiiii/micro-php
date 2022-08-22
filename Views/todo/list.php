<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Todo-List' ?></title>
    <style>
        @charset "UTF-8";

        body {
            margin: 0;
            display: grid;
            place-items: center;
            min-height: 100vh;
            background-color: #e5e5e5;
            font-family: system-ui, sans-serif;
            font-weight: 400;
            font-size: 14px;
            color: #484848;
        }

        .checkbox-container {
            padding: 18px;
            border: 1px solid #e5e5e5;
            background-color: #ffffff;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 250px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        .heading {
            margin-inline: 0;
            margin-block: 6px;
        }

        .checkbox-group {
            border: 1px solid #e5e5e5;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .checkbox-group.checked {
            background-color: #0d6efd;
            box-shadow: rgba(13, 110, 253, 0.25) 0px 8px 24px;
        }

        input[type=checkbox] {
            visibility: hidden;
        }

        input[type=checkbox]~label {
            position: relative;
        }

        input[type=checkbox]~label:before {
            content: "";
            position: absolute;
            border: 1px solid #e5e5e5;
            height: 14px;
            font-size: 12px;
            aspect-ratio: 1;
            top: 0;
            left: -26px;
            border-radius: 3px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
        }

        input[type=checkbox]:checked~label {
            color: #ffffff;
        }

        input[type=checkbox]:checked~label:before {
            content: "✔";
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="checkbox-container">
        <h2 class="heading">To-do list</h2>
        <?php $i = 0 ?>
        <?php foreach ($tasks as $task) : $i++ ?>
        <div class="checkbox-group">
            <input type="checkbox" id="checkbox<?=$i?>">
            <label for="checkbox<?=$i?>"><?= $task ?></label>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>