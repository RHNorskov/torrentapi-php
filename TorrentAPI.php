<?php

namespace TorrentAPI;

class TorrentAPI
{
    private $appID, $token;
    private $url = "https://torrentapi.org/pubapi_v2.php";

    public function __construct($appID = null)
    {
        $this->appID = $appID;
    }

    public function query($parameters = array())
    {
        // set token if empty
        if (!isset($this->token)) {
            $tokenRequest = $this->request(array("get_token" => "get_token"));

            if (isset($tokenRequest) && isset($tokenRequest->token)) {
                $this->token = $tokenRequest->token;
            }
        }

        // add token and appID to query
        $parameters["token"] = $this->token;
        $parameters["app_id"] = $this->appID;

        $request = $this->request($parameters);

        // throw exception if request was empty
        if (!isset($request)) {
            throw new Exception("Request was empty");
        }

        if (isset($request->error)) {
            // if token error get new token
            if (in_array($request->error_code, array(1, 2, 4))) {
                $this->token = $this->request(array("get_token" => "get_token"))->token;

                return $this->query($parameters);
            }

            // too many requests per second, wait and try again
            if ($request->error_code == 5) {
                sleep(2);
                return $this->query($parameters);
            }

            return $request;
        }

        return $request->torrent_results;
    }

    private function request($parameters)
    {
        return json_decode(file_get_contents($this->url . "?" . http_build_query($parameters)));
    }
}