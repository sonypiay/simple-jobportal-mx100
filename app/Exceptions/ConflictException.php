<?php

namespace App\Exceptions;

use App\Constants\HttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConflictException extends HttpResponseException
{
    public function __construct(string $message)
    {
        parent::__construct($message, HttpStatus::HTTP_CONFLICT);
    }

    public function render(Request $request): JsonResponse|Response
    {
        return parent::render($request);
    }
}
