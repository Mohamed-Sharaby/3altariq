<?php


namespace App\Services;


class FirestoreProviders
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new FireStore());
    }

    public function push($collection,$id,$data)
    {
       return $this->connection->firestore()->collection($collection)->document($id)->create($data);
    }

/*    public function getProviders()
    {
        return $this->providers;
    }*/

    public function filterProviders($service,$lat, $lng)
    {
        $providers=$this->connection->get('providers')->where('service_id','==',(int)$service)->where('is_online','==',true)->documents()->rows();
        $providers = (new ProvidersTransFormer($providers))->transform($lat,$lng);
        return $filtered_providers = $providers/*->where('distance','<=',70)*/->sortBy('distance')->take(50);

    }


}
