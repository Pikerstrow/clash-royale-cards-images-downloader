<?php
class ClashRoyaleCardsImagesDownloader {

    protected $cards_list;
    protected $destination_dirname;


    /**
     * ClashRoyaleCardsImagesDownloader constructor.
     * @param array $list
     * @param string $dirname
     */
    public function __construct(array $list, string $dirname)
    {
        $this->cards_list = $list;
        $this->destination_dirname = $dirname;
    }


    public function downloadImages()
    {
        foreach($this->cards_list as $card_info){
            $this->download($card_info);
        }
    }


    /**
     * @param array $image_data
     */
    public function download(array $image_data)
    {
        $url = $image_data['iconUrls']['medium'];
        $image_name = str_replace(' ', '_', $image_data['name']);
        $new_name = $image_name . '.png';

        $resource = curl_init($url);
        curl_setopt($resource, CURLOPT_VERBOSE, 1);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($resource, CURLOPT_AUTOREFERER, false);
        curl_setopt($resource, CURLOPT_REFERER, "https://api-assets.clashroyale.com");
        curl_setopt($resource, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($resource, CURLOPT_HEADER, 0);
        $result = curl_exec($resource);
        curl_close($resource);

        if($result){
            $this->saveImage($new_name, $result);
            print_r($image_data['name'] . " downloaded");
        } else {
            print_r("Failed!!!!!");
            die;
        }
    }


    private function saveImage(string $name, $response)
    {
        $resource = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'cards-images' . DIRECTORY_SEPARATOR . $name, 'w');
        fwrite($resource, $response);
        fclose($resource);
    }
}