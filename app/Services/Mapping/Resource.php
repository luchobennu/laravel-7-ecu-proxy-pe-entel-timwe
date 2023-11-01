<?php
namespace App\Services\Mapping;

class Resource {

    public static function getResource($data){

        //production
        // return file_get_contents(env("RESOURCE").$data);

        //development
        return file_get_contents(resource_path('/' . $data));
    }
}
