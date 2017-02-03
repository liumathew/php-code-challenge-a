<?php

namespace Connection;


class Connection {

    /**
     * Send curl request and returned the decoded response
     *
     * @param $url
     * @return mixed
     * @throws \Exception
     */
    public function curlRequest($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception('Communication Error');
        }

        $responseDecoded = json_decode($response);

        if ($responseDecoded === null) {
            throw new \Exception('Unable to decode the response, Json error: ' . json_last_error_msg(), json_last_error());
        }

        return $responseDecoded;
    }
} 