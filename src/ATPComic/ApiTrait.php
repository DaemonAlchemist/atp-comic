<?php

namespace ATPComic;

trait ApiTrait
{
    public function api($url, $query = []) {
        $response = \Httpful\Request::get(
            $this->siteParam('comic-rest-host') . $url . "?" . http_build_query($query)
        )
            ->addHeaders(['Api-Key' => $this->siteParam('comic-rest-api-key')])
            ->send();

        if($response->hasErrors()) {
            throw new \Exception($response->code);
        }

        return $response->body->results;
    }
}