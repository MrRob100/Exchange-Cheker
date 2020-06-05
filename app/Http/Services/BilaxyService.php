<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;
use App\Services\CheckService;


/**
 * Class BilaxyService
 * @package App\Services
 */
class BilaxyService
{
    public $exchange = "Bilaxy";

    /**
     * @param array $a
     *
     * @return o
     */
    public function getCoins()
    {
      $coinsRaw = json_decode(file_get_contents('https://newapi.bilaxy.com/v1/currencies'), true);
      $coins = array_keys($coinsRaw);
      return $coins;
    }

    public function check() 
    {

      $check = App::make('App\Services\CheckService');

      $check->check($this->exchange, $this->getCoins());

      //check/log price
      //scandir
      //find current exchang files
      //check timestamps and log accordingly

      $dir = 'public/data/price/';
      $files = scandir($dir);
      foreach($files as $file) {

        if (strpos($file, $this->exchange) !== false) {
          $data = json_decode(file_get_contents($dir.$file));
          if ($data['added'] < time() - 300) {
            //append price to 
          }
        }
      
        dump($file);
      }

    }

}