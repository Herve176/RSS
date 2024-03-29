<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RSS</title>
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
                $items = $xml->channel->item;
                echo '<ul>';
                foreach ($items as $item) {
                    $title = $item->title;
                    $description = $item->description;
                    $link = $item->link;
                    echo '<li>';
                    echo '<h3><a href="' . $link . '">' . $title . '</a></h3>';
                    echo '<p>' . $description . '</p>';
                    echo '</li>';
                }
                echo '</ul>';

                // Save RSS data as JSON file
                $data = [];
                foreach ($items as $item) {
                    $data[] = [
                        'title' => (string) $item->title,
                        'description' => (string) $item->description,
                        'link' => (string) $item->link,
                    ];
                }
                $jsonData = json_encode($data, JSON_PRETTY_PRINT);
                $file = 'rss_data.json';
                file_put_contents($file, $jsonData);
                echo 'RSS data saved as JSON in ' . $file;
            }
            ?>

        </form>
    </div>
</body>

</html>
