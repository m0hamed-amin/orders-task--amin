<?php

namespace  App\Http\Common;;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Trait APIResponse
 * @package App\Cores\PaymentServiceCore\Helpers
 */
trait APIResponse
{
    /**
     * @param       $data
     * @param  int  $code
     * @return JsonResponse
     */
    public function success($data, int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json(
            [
                'status' => [
                    'code' => $code,
                    'message' => trans('messages.success.default'),
                ],
                'data' => $data,
            ],
            $code
        );
    }

    /**
     * @param  array   $errors
     * @param  string  $message
     * @param  int     $code
     * @return JsonResponse
     */
    public function error(array $errors, string $message, int $code): JsonResponse
    {
        return response()->json(
            [
                'status' => [
                    'code' => $code,
                    'message' => $message,
                ],
                'errors' => $errors,
            ],
            $code
        );
    }
}
