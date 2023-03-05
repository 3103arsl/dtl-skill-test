<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpResponse;
use App\Helpers\HttpStatus;
use App\Helpers\Status;
use App\Helpers\UserTrait;
use App\Http\Controllers\Controller;

class ApiController extends Controller implements HttpStatus {
    use UserTrait;

    protected $model;
    protected $repository;
    protected $request;
    protected $httpResponse;


    public function __construct() {
        $this->httpResponse = new HttpResponse();
    }

    protected function getToken($token) {
        $token = explode('|', $token);
        return $token[count($token)-1];
    }
}
