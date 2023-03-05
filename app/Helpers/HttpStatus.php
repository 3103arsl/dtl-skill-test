<?php

namespace App\Helpers;

interface HttpStatus {

    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_ACCEPTED = 202;
    const STATUS_NO_CONTENT = 204;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_NOT_FOUND = 404;
    const STATUS_UNPROCESSABLE = 422;
}
