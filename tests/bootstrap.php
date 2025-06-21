<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

define('USER_NAME', 'tester');
define('PWD', 'grjxv2mxELR3');
define('BUCKET', 'sdkimg');
define('PIC_PATH', dirname(__FILE__) . '/assets/sample.jpeg');
define('PIC_SIZE', filesize(PIC_PATH));

function getFileUrl($path)
{
    return "http://" . BUCKET . ".b0.upaiyun.com/" . ltrim($path, '/');
}

function getUpyunFileSize($path)
{
    $url = getFileUrl($path);
    $client = new Client([
        'timeout' => 120,
        'connect_timeout' => 120,
        'http_errors' => false,
    ]);

    for ($i = 0; $i < 3; $i++) {
        try {
            $response = $client->head($url);
            if ($response->getStatusCode() === 200) {
                return (int) $response->getHeaderLine('Content-Length');
            }
        } catch (RequestException $e) {
            // 忽略网络异常，继续重试
        }
        usleep(500000); // 等待 500ms
    }

    return false;
}

