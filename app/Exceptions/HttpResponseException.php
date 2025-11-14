<?php

namespace App\Exceptions;

use Exception;
use App\Constants\HttpStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class HttpResponseException extends Exception
{
    private ?array $errors = null;

    public function __construct(string $message, int $code = HttpStatus::HTTP_INTERNAL_SERVER_ERROR, ?array $errors = null)
    {
        $this->message = $message;
        $this->code = $code;
        $this->errors = $errors;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function render(Request $request): JsonResponse|Response
    {
        $dataException = [
            'message' => $this->getMessage(),
            'path' => $this->getFile(),
            'line' => $this->getLine(),
            'code' => $this->getCode(),
            'url' => request()->fullUrl(),
        ];

        $response = [
            'message' => $this->getMessage(),
        ];

        if( ! empty( $this->getErrors() ) ) {
            $response['errors'] = $this->getErrors();
        }  

        if( ! app()->environment('production') ) {
            $response['exception'] = $dataException;
        }

        Log::error(json_encode($dataException, JSON_PRETTY_PRINT));

        if( $request->expectsJson() ) {
            return response()->json($response, $this->getCode());
        }

        return abort($this->code, $this->message);
    }
}
