<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        max-width: 88%;
        background-color: red;
        margin: auto;
        padding: 23px;
    }
</style>

<body>
    <div class="container">
        <h1>Let's Learn Php</h1>
        <p>Let's Do It Together</p>
        <?php
        $age = 10;
        if ($age > 18) {
            echo "You Can Do It";
        } else if ($age == 71) {
            echo "Practice More";
        } else if ($age == 8) {
            echo "Practice Must Be";
        } else {
            echo "You Can't Do It";
        }
        $languages = array("Python", "C++", "PHP");
        // echo  count($languages);
        // echo $languages[1];
        $a = 0;
        while ($a <= 10) {
            echo "The value of a is:";
            echo $a;
            $a++;
        }

        ?>
    </div>
</body>

</html>