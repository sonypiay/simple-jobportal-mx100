<?php

namespace App\Exceptions;

use App\Constants\HttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BadRequestException extends HttpResponseException
{
    public function __construct(string $message, ?array $errors = null)
    {
        parent::__construct($message, HttpStatus::HTTP_BAD_REQUEST, $errors);
    }

    public function render(Request $request): JsonResponse|Response
    {
        return parent::render($request);
    }
}
