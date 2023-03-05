<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class HttpResponse implements HttpStatus{

    private $data;
    private $status;

    public function __construct($data = [], $status = self::STATUS_OK) {
        $this->data = $data;
        $this->status = $status;
    }

    public function setResponse($data, $status) {
        $this->data = $data;
        $this->status = $status;
        return $this->generate();

    }

    public function getResponse() {
        return new Response([
            'data' => $this->data,
        ], $this->status);
    }

    public function getJsonResponse() {
        return new Response([
            'data' => response()->json($this->data),
        ], $this->status);
    }

    public function setJsonResponse($data, $status) {
        $this->data = $data;
        $this->status = $status;
        return response()->json($this->data, $this->status);
    }

    private function generate() {
        return new Response([
            'data' => $this->data,
        ], $this->status);
    }
}
