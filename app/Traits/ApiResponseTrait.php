<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

trait ApiResponseTrait
{
    /**
     * Success response
     */
    protected function successResponse($data = null, string $message = 'Success', int $code = 200, int $total = null): JsonResponse
    {
        $response = [
            'status' => true,
            'code' => $code,
            'message' => $message,
            'total' => $total ?? (is_countable($data) ? count($data) : ($data ? 1 : 0)),
            'data' => $data,
            'meta' => $this->getMetaData()
        ];

        return response()->json($response, $code);
    }

    /**
     * Error response
     */
    protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
    {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
            'meta' => $this->getMetaData()
        ];

        if ($errors === null) {
            unset($response['errors']);
        }

        return response()->json($response, $code);
    }

    /**
     * Validation error response
     */
    protected function validationErrorResponse($errors, string $message = 'Validation Error', int $code = 422): JsonResponse
    {
        return $this->errorResponse($message, $code, $errors);
    }

    /**
     * Get metadata for response
     */
    private function getMetaData(): array
    {
        return [
            'timestamp' => now()->toISOString(),
            'path' => request()->path(),
            'execution_time' => $this->getExecutionTime(),
            'request_id' => $this->getRequestId()
        ];
    }

    /**
     * Get execution time in milliseconds
     */
    private function getExecutionTime(): string
    {
        if (defined('LARAVEL_START')) {
            $executionTime = microtime(true) - LARAVEL_START;
            return round($executionTime * 1000, 2) . ' ms';
        }
        return '0 ms';
    }

    /**
     * Generate or get request ID
     */
    private function getRequestId(): string
    {
        return request()->header('X-Request-Id', Str::uuid()->toString());
    }
}