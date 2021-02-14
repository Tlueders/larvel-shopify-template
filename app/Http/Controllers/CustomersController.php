<?php

namespace App\Http\Controllers;

use App\Http\Services\ShopifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ShopifyService();
    }

    public function index(Request $request)
    {
        $token = Auth::user()->providers[0]->provider_token;
        $domain = Auth::user()->stores[0]->domain;

        $data = $this->service->getCustomers($token, $domain);
        $data = json_decode($data, true);
        $data = $data['customers'];

//        dd($data);

        return view('dashboard', ['customers' => $data]);
    }
}
