<?php
/**
 * Created by PhpStorm.
 * User: jmd
 * Date: 2018/11/1
 * Time: 14:02
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PHPZxing\PHPZxingDecoder;

$decoder = new PHPZxingDecoder();
//$decoder->setJavaPath('"C:\Program Files (x86)\Common Files\Oracle\Java\javapath\java.exe"');

$dir = __DIR__ . '/image';
$files = array_diff(scandir($dir), array('.', '..'));

foreach ($files as $file) {
    $path = "$dir/$file";
    $result = $decoder->decode($path);
    if (!$result->isFound()) {
        echo "$path, [decode fail]";
        continue;
    }
    $format = $result->getFormat();
    $type = $result->getType();
    $imgPath = $result->getImagePath();
    $value = $result->getImageValue();

    $data = [
        'path' => $imgPath,
        'format' => $format,
        'type' => $type,
        'value' => $value,
    ];
    print_r($data);
}