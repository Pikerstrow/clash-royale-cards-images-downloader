<?php


class ClashRoyaleBadgesParser
{
    protected $destination_dirname;
    protected $base_url;


    public function __construct()
    {
        $this->destination_dirname = __DIR__ . DIRECTORY_SEPARATOR . 'other-images' . DIRECTORY_SEPARATOR . 'badges' . DIRECTORY_SEPARATOR;
        $this->base_url = 'https://cdn.statsroyale.com/images/badges/';
    }


    /**
     * @param $image_id
     * @return string
     */
    public function download($image_id)
    {
        $url = $this->base_url . $image_id . '.png';
        $image_name = $image_id . '.png';

        $resource = curl_init($url);
        curl_setopt($resource, CURLOPT_VERBOSE, 1);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($resource, CURLOPT_AUTOREFERER, false);
        curl_setopt($resource, CURLOPT_REFERER, "https://cdn.statsroyale.com");
        curl_setopt($resource, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($resource, CURLOPT_HEADER, 0);
        $result = curl_exec($resource);
        curl_close($resource);

        if($result){
            $this->saveImage($image_name, $result);
            return '/other-images/badges/' . $image_name;
        } else {
            die;
        }
    }

    /**
     * @param string $name
     * @param $response
     */
    private function saveImage(string $name, $response)
    {
        $resource = fopen($this->destination_dirname . $name, 'w');
        fwrite($resource, $response);
        fclose($resource);
    }


}