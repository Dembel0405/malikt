<?php
ini_set("display_errors", 1);

function get ($link) {
    $agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'; 
    $ch = curl_init($link);
      curl_setopt($ch, CURLOPT_USERAGENT, $agent);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response_data = curl_exec($ch);
    curl_close($ch);
    return $response_data;
}

class currency {

    public $object;

    public function parsing () {

        if (false == ($dataObj = simplexml_load_file("http://www.nationalbank.kz/rss/rates_all.xml"))) {
            return "nbrk upal";
        } else {
            foreach ($dataObj->channel->item as $item) {
                if ($item->title == "USD") {
                    $usd = $item->description;
                }
                if ($item->title == "EUR") {
                    $eur = $item->description;
                }
                if ($item->title == "RUB") {
                    $rub = $item->description;
                }       
            }
        }

        if (false == ($data = get("https://ifin.kz/exchanger/malik-t/branch/33352?city=aktobe"))) {
            return error_get_last();
        } else {
            preg_match_all('/<div class="currency-rate-big">\s*(\d+\.\d+)\s*<\/div>/m', $data, $currency, PREG_SET_ORDER, 0);
            preg_match_all('/<div class="text-detail date-rate">(.+?)<\/div>/m', $data, $time, PREG_SET_ORDER, 0);

            $object = (object) [
                "update" => $time[0][1], 
                "usd" => (object) [
                    "buy" => (string) $currency[0][1], 
                    "sell" => (string) $currency[1][1],
                    "nbrk" => (string) $usd
                ], 
                "eur" => (object) [
                    "buy" => (string) $currency[2][1], 
                    "sell" => (string) $currency[3][1],
                    "nbrk" => (string) $eur
                ], 
                "rub" => (object) [
                    "buy" => (string) $currency[4][1], 
                    "sell" => (string) $currency[5][1],
                    "nbrk" => (string) $rub
                ]];
            
            return file_put_contents(__DIR__."/currency.json", json_encode($object));

            // return $object;
        }
    }

}

    echo json_encode((new currency())->parsing());

?>