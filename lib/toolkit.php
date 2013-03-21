<?php

function fetchurl($src) {
    $content = '';
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $src);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
        $content = curl_exec($ch);
        curl_close($ch);
    } elseif ((boolean) ini_get('allow_url_fopen')) {
        $content = file_get_contents($src);
    } else {
        $src = parse_url($src);
        $host = $src['host'];
        $path = $src['path'];
        $line = '';
        if (($s = @fsockopen($host, 80, $errno, $errstr, 5)) === false) {
            return false;
        }
        fwrite($s, 'GET ' . $path . " HTTP/1.0\r\n"
                . 'Host: ' . $host . "\r\n"
                . "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:2.0b13pre) Gecko/20110307 Firefox/4.0b13pre\r\n"
                . "Accept: text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*\r\n"
                . "\r\n"
        );
        while (!feof($s)) {
            $content.=fgets($s, 4096);
        }
        fclose($s);
    }
    if ($content) {
        return $content;
    }
}