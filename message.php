<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Study KPI</title>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <link rel="stylesheet" href="../css/mainStyle.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background-color: #ebeff4;
            text-align: center;
            font-family: inherit;
            padding: 20px 20px 20px 10px;
            border-radius: 6px;
            border: none;
            display: block;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            font-size: 17px;
            color: #4A4A4A;
        }
    </style>
</head>

<body>
    <?php
    function messageBox($test)
    {
    ?>
        <div class="box">
            <?php echo $test; ?>
        </div>
    <?php
    }
    ?>
</body>

</html>