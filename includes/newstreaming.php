<?php
// Include the prompts
include "prompts.php";

// Function to stream data from OpenAI
function streamFromOpenAI($userInput, $apiKey) {
    global $prependText; // Use the global prompt variable

    $url = "https://api.openai.com/v1/chat/completions";

    // Prepare the request payload
    $payload = json_encode([
        "model" => "gpt-4o",
        "messages" => [
            ["role" => "system", "content" => $prependText],
            ["role" => "user", "content" => $userInput]
        ],
        "stream" => true
    ]);

    // Initialize cURL session
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Stream the data to the client
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $data) {
        echo "data: " . trim($data) . "\n\n";
        ob_flush();
        flush();
        return strlen($data);
    });

    curl_exec($ch);
    curl_close($ch);
}

// Retrieve user input and include the prompt
$userInput = isset($_POST['userMessage']) ? $_POST['userMessage'] : "Hello!";
streamFromOpenAI($userInput, $apiKey);
