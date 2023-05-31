<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML 5 Boilerplate</title>
</head>

<body>
    <div>
        <form method="post" action="">
            <input name="rss" type="text" placeholder="Enter RSS URL">
            <input type="submit"><br>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rss = $_POST['rss'];
                $xml = simplexml_load_file($rss);
                $arrayData = json_decode(json_encode($xml), true);
                $jsonData = json_encode($arrayData);
                echo '<pre>';
                echo json_encode($json_data, JSON_PRETTY_PRINT);
                echo '</pre>';
                $file = 'rss_data.json';
                file_put_contents($file, $jsonData);
                echo 'RSS data saved as JSON in ' . $file;
            }
            ?>

        </form>
    </div>
</body>

</html>