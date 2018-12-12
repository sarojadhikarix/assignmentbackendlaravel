<?php
/**
 * Created by PhpStorm.
 * User: ayush
 * Date: 06/12/2018
 * Time: 12.30
 */

namespace App;


class backendApi
{
    protected $url = 'http://site.com/wp-json/wp/v2/';

    public function importPosts($id = 1)
    {
        $posts = collect($this->getJson($this->url .$id));
        foreach ($posts as $post) {
            $this->syncPost($post);
            echo $post;
        }
    }

    protected function getJson($url)
    {
        $response = file_get_contents($url, false);
        return json_decode( $response );
    }
}