<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the API key
include 'apikey.php';

// Path to save the uploaded audio file locally
$audioFilePath = '/home2/eslology/public_html/anglesmontalt/dugaldsteer/includes/response.wav';

// Check if streaming is requested
if (isset($_GET['stream']) && $_GET['stream'] === 'true') {
    handleStreaming($_POST['userMessage'], $apiKey);
    exit;
}

// Handle audio file upload and processing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio_file'])) {
    handleAudioProcessing($_FILES['audio_file'], $audioFilePath, $apiKey);
    exit;
}

// Function to handle streaming
function handleStreaming($userMessage, $apiKey) {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');

    $url = "https://api.openai.com/v1/chat/completions";
    $payload = json_encode([
        "model" => "gpt-4o",
        "messages" => [
            ["role" => "system", "content" => "You are a helpful assistant."],
            ["role" => "user", "content" => $userMessage]
        ],
        "stream" => true
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $data) {
        echo "data: " . trim($data) . "\n\n";
        ob_flush();
        flush();
        return strlen($data);
    });

    curl_exec($ch);
    curl_close($ch);
}

// Function to handle audio file processing
function handleAudioProcessing($file, $audioFilePath, $apiKey) {
    if (file_exists($audioFilePath)) {
        unlink($audioFilePath);
    }

    if (move_uploaded_file($file['tmp_name'], $audioFilePath)) {
        $transcription = transcribeAudio($audioFilePath, $apiKey);
        $responseText = getResponseFromGPT($transcription, $apiKey);
        $audioSpeech = generateSpeechFromText($responseText, $apiKey);

        if (file_put_contents($audioFilePath, $audioSpeech)) {
            $audioUrl = 'https://www.anglesmontalt.com/dugaldsteer/includes/response.wav?' . time();
            echo json_encode([
                'audioUrl' => $audioUrl,
                'textResponse' => $responseText
            ]);
        } else {
            echo json_encode(["error" => "Failed to write generated audio file."]);
        }
    } else {
        echo json_encode(["error" => "Error uploading file."]);
    }
}

// Function to transcribe audio
function transcribeAudio($audioFilePath, $apiKey) {
    $url = 'https://api.openai.com/v1/audio/transcriptions';
    $postFields = [
        'file' => new CURLFile($audioFilePath),
        'model' => 'whisper-1'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $apiKey"]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $decoded = json_decode($response, true);
    return $decoded['text'] ?? "Error transcribing audio.";
}

// Function to get GPT response
function getResponseFromGPT($inputText, $apiKey) {
    $url = 'https://api.openai.com/v1/chat/completions';
    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => $inputText]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $decoded = json_decode($response, true);
    return $decoded['choices'][0]['message']['content'] ?? "Error getting GPT response.";
}

// Function to generate speech from text
function generateSpeechFromText($text, $apiKey) {
    $url = 'https://api.openai.com/v1/audio/speech';
    $data = [
        'model' => 'tts-1',
        'input' => $text,
        'voice' => 'alloy'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $audioResponse = curl_exec($ch);
    curl_close($ch);

    return strlen($audioResponse) > 100 ? $audioResponse : "Error generating speech.";
}
?>
