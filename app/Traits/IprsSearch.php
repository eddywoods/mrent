<?php

namespace App\Traits;

use App\UserCache;
use App\UserSearch;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
use stdClass;

trait IprsSearch
{

  function searchById($data)
  {

    if ($data['citizenship'] == "kenyan") {
      $search = "Kenyan";
    } else {
      $search = "Alien";
    }
    $usercache = UserCache::where('id_number', $data['id_number'])
      ->where('citizenship', $search)
      ->first();


    if ($usercache) {

      $usercache = UserCache::where('id_number', $data['id_number'])->where('citizenship', $search)->first();

      $usercache->valid = true;

      return $usercache;
    } else {
      
      $client = new Client();

      $url = config("services.iprs.IPRS_URL") . "/databyid?number=" . $data['id_number'];
  
      if ($data['citizenship'] != "kenyan") {
        $url = config("services.iprs.IPRS_URL") . "/databyalienid?number=" . $data['id_number'];
      }
  
      try {
  
        $res = $client->get($url, [
          'auth' => [
            config('services.iprs.IPRS_KEY'),
            config('services.iprs.IPRS_SECRET')
          ]
        ]);
  
         $response = json_decode($res->getBody()->getContents(), true);
  
         if ($response['valid']) {
           $response['valid'] = 1;
         } else {
           $response['valid'] = 0;
         }
  
        // user found
        if ($response['valid']) {
          $this->saveUserCache($response);
          $this->saveUserSearch($response);
        }
      } catch (ClientException $e) {
        $response = new stdClass();
        $response->valid = false;
        Log::error($e->getMessage());
      } catch (\Exception $e) {
        $response = new stdClass();
        $response->valid = false;
        Log::error($e->getMessage());
  
      }
  
      return $response;
    }

   

  }

  function saveUserCache($data)
  {

    if ($data['citizenship'] == "kenyan") {
      $search = "Kenyan";
    } else {
      $search = "Alien";
    }

    $user = UserCache::where('id_number', $data['id_number'])
      ->where('citizenship', $search)
      ->first();


    if (!$user) {

      UserCache::create([
        "surname" => $data['surname'],
        "photo" => $data['photo'],
        "other_name" => $data['other_name'],
        "id_number" => $data['id_number'],
        "gender" => $data['gender'],
        "first_name" => $data['first_name'],
        "dob" => $data['dob'],
        "citizenship" => $data['citizenship'],
      ]);
    } else {
      $user->update([
        "surname" => $data['surname'],
        "photo" => $data['photo'],
        "other_name" => $data['other_name'],
        "id_number" => $data['id_number'],
        "gender" => $data['gender'],
        "first_name" => $data['first_name'],
        "dob" => $data['dob'],
        "citizenship" => $data['citizenship'],
      ]);
    }
  }

  function saveUserSearch($data)
  {
    UserSearch::create([
      'id_number' => $data['id_number'],
      'citizenship' => $data['citizenship']
    ]);
  }
}
