<?php


namespace App\Services;


use Kreait\Firebase\Factory;

class FireStore
{
    private $firestore;
    public function __construct()
    {
        $this->firestore = (new Factory)->withServiceAccount(base_path('ealtreq-app-firebase-adminsdk-9lc4k-87f7630005.json'))->createFirestore()->database();

    }

    public function firestore()
    {
        return $this->firestore;
    }
    public function get($collection)
    {
        return $this->firestore->collection($collection);
    }


}
