<?php

namespace App\Exceptions;

use Exception;

class ProductNotfound extends Exception
{
    public function render($request, Exception $exception)
    {
        // This will replace our 404 response with
        // a JSON response.
        if ($exception instanceof ProductNotfound) {
            return response()->json([
                'error' => 'Product not found'
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
