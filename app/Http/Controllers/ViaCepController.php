<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViaCepController extends Controller
{
    public function getCep($cep)
    {
        try {
                $cep = (integer) str_replace('-', '', $cep);
                $response = Http::withoutVerifying()
                            ->withHeaders([
                                'Access-Control-Allow-Origin' => '*',
                                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                                'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
                            ])
                            ->get('https://viacep.com.br/ws/'
                            .str_pad($cep, 8, 0, STR_PAD_LEFT)
                            .'/json/');
                return $response;
            } catch (\Throwable $th) {
                throw $th;
            }
        
    }
    public function curl($cep)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => 'https://viacep.com.br/ws/'.$cep.'\/json/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return $response;
        }
    }
}
