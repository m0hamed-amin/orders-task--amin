<?php

namespace Tests\Feature;

use http\Env\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;
    public string $url = '/api/orders';
    public array $headers = [];
    public array $payload = [
        "products" => [
            [
                "product_id" => 1,
                "quantity" => 2
            ],]];

    public function test_api_structure(): void
    {
        $this->withExceptionHandling();
        $response = $this->json('POST', $this->url, $this->payload, $this->headers);
        $response->assertJsonStructure(
            [
                "status" => [
                    "code" ,
                    "message",
                ],
                "data" => [
                ],
            ]
        );
    }

    public function test_create_order()
    {
        $response = $this->json('POST', $this->url , $this->payload, $this->headers);
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    public function test_api_validation_create_order()
    {
        $this->payload = [
        "products" => [
                "quantity" => 2
            ,]];
        $response = $this->json('POST', $this->url , $this->payload, $this->headers);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}

