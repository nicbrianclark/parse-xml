<?php

// Define the URL of the RSS feed
$feed_url = "https://www.bbc.co.uk/news/rss.xml";  // Replace with your chosen URL

// Download the XML content using file_get_contents
$xml_string = file_get_contents($feed_url);

// Check if download was successful
if ($xml_string === false) {
  echo "Error: Could not download the RSS feed.";
  exit;
}

// Parse the XML content using SimpleXML
$xml = simplexml_load_string($xml_string);

// Check if parsing was successful
if ($xml === false) {
  echo "Error: Could not parse the XML data.";
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $xml->channel->title; ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <main>
        <div class="heading"><h1>Top Stories from <?php echo $xml->channel->title; ?></div>
        <div class="stories">
            <ul>
                <?php foreach ($xml->channel->item as $item) : ?>
                    <li>
                        <h2><?php echo $item->title; ?></h2>
                        <p><?php echo $item->description; ?></p>
                        <a href="<?php echo $item->link; ?>" class="readmore" target="_blank">Read More</a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </main>
</body>
</html>