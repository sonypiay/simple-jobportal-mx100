<?php

namespace App\Exceptions;

use App\Constants\HttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotFoundException extends HttpResponseException
{
    public function __construct(string $message)
    {
        parent::__construct($message, HttpStatus::HTTP_NOT_FOUND);
    }

    public function render(Request $request): JsonResponse|Response
    {
        return parent::render($request);
    }
}
