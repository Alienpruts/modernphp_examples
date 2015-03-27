<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 3/27/15
 * Time: 6:43 PM
 */

require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();

$csv = \League\Csv\Reader::createFromPath($argv[1]);
$csv->setFlags(SplFileObject::SKIP_EMPTY);

$data = $csv->fetchAll();
foreach ($data as $csvRow) {
    try {
        $httpResponse = $client->get($csvRow[0]);

        if ($httpResponse->getStatusCode() >= 400) {
            throw new \Exception();
        }

    } catch (\Exception $e) {
        echo 'exception at ' . $csvRow[0] . PHP_EOL;
    }

}