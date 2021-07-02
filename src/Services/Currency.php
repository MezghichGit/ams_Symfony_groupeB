<?php
namespace App\Services;

class Currency
{

    /**
    * Retourne le cours de conversion entre deux devices différentes
    *
    * @param string $from
    * @param string $to
    * @param string $amount
    * @return string
    */
    public function conversion($from,$to,$amount) {

        $json = file_get_contents('http://apilayer.net/api/live?access_key=835619f33bdee310a1d454b38c9821a3&currencies='.$to.'&source='.$from.'&format=1');
        $json = json_decode($json, true);
        $ouput = $from.$to;
        return $amount * floatval($json['quotes'][$ouput]);
    }
}