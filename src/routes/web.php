<?php
use Illuminate\Support\Facades\Cache;

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

function get_cep_data($cep){
    $url = "https://viacep.com.br/ws/$cep/json/";

    // Inicializa o cURL
    $ch = curl_init();

    // Configura as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Executa a requisição e obtém a resposta
    $response = curl_exec($ch);

    // Verifica se ocorreu algum erro
    if (curl_errno($ch)) {
        echo 'Erro:' . curl_error($ch);
    }

    // Fecha o cURL
    curl_close($ch);

    // Decodifica o JSON
    $data = json_decode($response, true);
    $logradouro = $data['logradouro'];
    $localidade = $data['localidade'];
    $data['label'] = "$logradouro, $localidade";
    unset($data['unidade']);
    $data['cep'] = str_replace('-','',$data['cep']);
    return $data;
}

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/search/local/{ceps}', function ($ceps) {    
    $cepArray = explode(',', $ceps);    
    $addressData = array();        
    //usando cache para evitar conexões demais pra API do viacep
    for ($i=0; $i < count($cepArray); $i++) { 
        $cep = $cepArray[$i];
        if(Cache::has($cep)){
            array_push($addressData,Cache::get($cep));
            continue;
        }
        $cepData = get_cep_data($cepArray[$i]);
        Cache::put($cep,$cepData,60);
        array_push($addressData,$cepData);
    }    
    return response()->json([
        'status' => 'success',
        'data' => $addressData,
    ]);
});