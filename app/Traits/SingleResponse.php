<?php
namespace App\Traits;

use DomainException;

trait SingleResponse {

    private $generic = [
        'isOk'=> true,
        'mensaje' => null,
        'response' => null,
        'code' => 200,
        'errors' => []
    ];

    public function response($data = []){

        $result = (object) array_merge((array) $this->generic, (array) $data);
        $this->generic = $result;
        return response()->json($result, 200);
    }

    public function error(DomainException $de){

        $this->generic['isOk'] = false;
        $this->generic['mensaje'] = $de->getMessage();
        report($de);
    }

    public function getResponse(){
        return $this->generic;
    }
}
