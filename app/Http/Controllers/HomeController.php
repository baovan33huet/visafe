<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        $data = [
            'gender' => 0,
            'seniorCitizen' => 0,
            'partner' => 0,
            'dependents' => 0,
            'tenure' => 1,
            'phoneService' => 2,
            'multipleLines' => 1,
            'contract_Month_to_month' => 0,
            'contract_One_year' => 1,
            'contract_Two_year' => 0,
            'internetService_DSL' => 0,
            'internetService_Fiber_optic' => 1,
            'internetService_No' => 0,
            'onlineSecurity' => 0,
            'onlineBackup' => 0,
            'deviceProtection' => 0,
            'techSupport' => 0,
            'streamingTV' => 1,
            'streamingMovies' => 1,
            'paperlessBilling' => 1,
            'paymentMethod_Bank_transfer' => 1,
            'paymentMethod_Credit_card' => 0,
            'paymentMethod_Electronic_check' => 0,
            'paymentMethod_Mailed_check' => 0,
            'monthlyCharges' => 175000,
            'totalCharges' => 175000,
        ];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://127.0.0.1:5001/predict', $data);

        $predict = $response->json()['prediction'];
        return $predict;
    }

}
