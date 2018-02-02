<?php

namespace ATPComic;

trait ApiTrait
{
    public function api($url, $query = []) {
        $response = \Httpful\Request::get(
            $this->siteParam('comic-rest-host') . $url . "?" . http_build_query($query)
        )
            ->addHeaders(['Login-Token' => $this->siteParam('comic-rest-login-token')])
            ->send();

        if($response->hasErrors()) {
            throw new \Exception($response->code);
        }

        return $response->body->results;
    }
}