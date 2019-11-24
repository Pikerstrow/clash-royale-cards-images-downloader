<?php
require_once  "ClashRoyaleCardsImagesDownloader.php";

$file = file_get_contents('response-example.json');
$file_array = json_decode($file, true);
$cards_list = $file_array['cards'];

$downloader = new ClashRoyaleCardsImagesDownloader($cards_list, 'card-images');
$downloader->downloadImages();