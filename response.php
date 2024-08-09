<?php
// Configura tu clave API
$api_key = 'AIzaSyCmmM2OPmB5uX_nEg5woNOB-KVXx_WpRq0';

// Obtén la entrada del frontend
$data = json_decode(file_get_contents('php://input'), true);
$text = $data['text'];

// Configura la solicitud a la API de Gemini
$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $api_key;

$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => $text]
            ]
        ]
    ]
];

// Inicializa cURL
$curl = curl_init();

// Configura las opciones de cURL
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ]
]);

// Envía la solicitud y obtén la respuesta
$response = curl_exec($curl);

// Verifica si hubo errores
if (curl_errno($curl)) {
    echo 'Error en cURL: ' . curl_error($curl);
} else {
    // Decodifica la respuesta JSON
    $result = json_decode($response, true);
    
    // Extrae el texto de la respuesta
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        echo $result['candidates'][0]['content']['parts'][0]['text'];
    } else {
        echo 'No se pudo obtener una respuesta válida de la API.';
    }
}

// Cierra la conexión cURL
curl_close($curl);