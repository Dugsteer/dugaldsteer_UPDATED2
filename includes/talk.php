<?php
// Enable error reporting to debug any issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the API key from apikey.php
include 'apikey.php';

// Path to save the uploaded audio file locally
$audioFilePath = '/home2/eslology/public_html/anglesmontalt/dugaldsteer/includes/response.wav';

// Check if the request method is POST and if a file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio_file'])) {
    // Log the received file details for debugging
    error_log("Received file: " . $_FILES['audio_file']['name']);
    error_log("File type: " . $_FILES['audio_file']['type']);
    error_log("File size: " . $_FILES['audio_file']['size']);

    // Delete the old audio file if it exists
    if (file_exists($audioFilePath)) {
        unlink($audioFilePath);
        error_log("Old file deleted: " . $audioFilePath);
    }

    // Move the uploaded file to the local path
    if (move_uploaded_file($_FILES['audio_file']['tmp_name'], $audioFilePath)) {
        error_log("File uploaded successfully: " . $audioFilePath);

        // Step 1: Transcribe the audio file using OpenAI's Whisper model
        $transcription = transcribeAudio($audioFilePath, $apiKey);

        // Step 2: Send the transcription to GPT for a response
        $responseText = getResponseFromGPT($transcription, $apiKey);

        // Step 3: Generate audio response (text-to-speech) using OpenAI TTS
        $audioSpeech = generateSpeechFromText($responseText, $apiKey);

        // Step 4: Save the generated audio as a WAV file
        if (file_put_contents($audioFilePath, $audioSpeech)) {
            // Log success
            error_log("Generated audio file saved successfully: " . $audioFilePath);

            // Return both the chatbot's response and the audio file URL to the frontend
            $audioUrl = 'https://www.anglesmontalt.com/dugaldsteer/includes/response.wav?' . time(); // Prevent caching
            echo json_encode([
                'audioUrl' => $audioUrl,
                'textResponse' => $responseText
            ]);
        } else {
            error_log("Failed to write generated audio file.");
            echo json_encode(["error" => "Failed to write generated audio file."]);
        }
    } else {
        error_log("Error uploading file.");
        echo json_encode(["error" => "Error uploading file."]);
    }
} else {
    error_log("No file uploaded or incorrect request.");
    echo json_encode(["error" => "No file uploaded or incorrect request."]);
}

// Function to transcribe audio using OpenAI's Whisper model
function transcribeAudio($audioFilePath, $apiKey) {
    $url = 'https://api.openai.com/v1/audio/transcriptions';
    $postFields = [
        'file' => new CURLFile($audioFilePath),
        'model' => 'whisper-1'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $decoded = json_decode($response, true);
    if (isset($decoded['text'])) {
        return $decoded['text'];
    } else {
        error_log("Error transcribing audio: " . json_encode($decoded));
        return "Error transcribing audio.";
    }
}

// Function to get a response from OpenAI GPT
function getResponseFromGPT($inputText, $apiKey) {
    $url = 'https://api.openai.com/v1/chat/completions';
    $data = [
        'model' => 'gpt-3.5-turbo', // Or gpt-4 if using GPT-4
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
    if (isset($decoded['choices'][0]['message']['content'])) {
        return $decoded['choices'][0]['message']['content'];
    } else {
        error_log("Error getting GPT response: " . json_encode($decoded));
        return "Error getting GPT response.";
    }
}

// Function to convert text to speech using OpenAI's TTS
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

    if ($audioResponse === false || strlen($audioResponse) < 100) {
        error_log("Error generating speech: " . ($audioResponse === false ? curl_error($ch) : "Response too small."));
        return "Error generating speech.";
    }

    return $audioResponse;
}
?>
