<?php

namespace ATPComic;

trait ApiTrait
{
    public function api($url, $query = []) {
        return \Httpful\Request::get(
            $this->siteParam('comic-rest-host') . $url . "?" . http_build_query($query)
        )
            ->addHeaders(['Login-Token' => $this->siteParam('comic-rest-login-token')])
            ->send()
            ->body->results;
    }
}