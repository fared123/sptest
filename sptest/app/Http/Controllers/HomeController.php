<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DOMDocument;
use DOMXPath;

class HomeController extends Controller {

    public function index() {
        return view('home.index');
    }

    public function getData(Request $request) {

        $airport = $request->airport;
        $dateA = $request->dateA;
        $dateB = $request->dateB;
        $quoteID = $request->quoteID;

        //$quoteID = '542a00675e4ead5ec87253e3c71eb7b07e7f3344';
        $url = 'https://www.ukmeetandgreet.com/booking-quote/airportparking-list?quoteID=' . $quoteID . '&agent=UKMEET&passengers=1&category=airportparking&params=%5B%5D&terminal=&account=&promo=&airportA=' . $airport . '&dateA=' . $dateA . '&_dateA=Thu%2C+10%2F05%2F18&timeA=12%3A00&dateB=' . $dateB . '&_dateB=Thu%2C+17%2F05%2F18&timeB=12%3A00';

        $html = $this->curl_get_contents($url, $airport, $dateA, $dateB);

        $domDoc = new DOMDocument();
        libxml_use_internal_errors(true);
        $domDoc->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXpath($domDoc);

        $products = $xpath->query("//h2/a[@class='MoreInfoAction']");
        $prices = $xpath->query("//span[@class='price']");

        $count = $products->length;

        $results = [];

        $fp = fopen('prices.csv', 'w');
        $csv = "";
        for ($i = 0; $i < $count; $i++) {
            $results[] = ['product' => trim($products[$i]->nodeValue), 'price' => trim($prices[$i]->nodeValue)];
            fwrite($fp, '"' . trim($products[$i]->nodeValue) . '","' . trim($prices[$i]->nodeValue) . '"' . PHP_EOL);
        }
        fflush($fp);
        fclose($fp);

        $fp = fopen('prices.json', 'w');
        fwrite($fp, json_encode($results));
        fflush($fp);
        fclose($fp);

        return view('home.view', [
            'results' => $results,
        ]);
    }

    function curl_get_contents($url, $airport, $dateA, $dateB) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $output = curl_exec($ch);
        $last_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);
        return $output;
    }

}
