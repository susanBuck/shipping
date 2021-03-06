<?php
namespace pdt256\Shipping\RateRequest;

class Post extends Adapter
{
    public function execute($url, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $this->curlConnectTimeoutInMilliseconds);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->curlDownloadTimeoutInSeconds);
        $response = curl_exec($ch);
        if ($response === false) {
            throw new RequestException(curl_error($ch));
        }
        curl_close($ch);

        return $response;
    }
}
