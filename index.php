<?php
require_once  "ClashRoyaleCardsImagesDownloader.php";
require_once "ClashRoyaleBadgesParser.php";


//$file = file_get_contents('response-example.json');
//$file_array = json_decode($file, true);
//$cards_list = $file_array['cards'];
//
//$downloader = new ClashRoyaleCardsImagesDownloader($cards_list, 'card-images');
//$downloader->downloadImages();

$badges_parser = new ClashRoyaleBadgesParser();
$badges_parser->download(16000154);