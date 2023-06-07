<?php
for ($i = 0; $i < 4; $i++) {
    $rss = array("https://www1.cbn.com/rss-cbn-articles-cbnnews.xml", "https://www1.cbn.com/rss-cbn-blogs-thebrodyfile.xml", "https://www1.cbn.com/rss-cbn-blogs-jerusalemdateline.xml", "https://www1.cbn.com/rss-cbn-blogs-hurdontheweb.xml");
    $rss = $rss[$i];
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
    $file = "rss_data{$i}.json";
    file_put_contents($file, $jsonData);
    echo 'RSS data saved as JSON in ' . $file;
}
