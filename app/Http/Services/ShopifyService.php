<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ShopifyService
{
    public function getCustomers(string $token, string $domain)
    {
        $path = 'https://' . $domain . '/admin/api/2021-01/customers.json';

        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $token
        ])->get($path);

        return $response->body();
    }
}
