<?php


// Include API key and necessary chat variables
include "apikey.php";
include "prompts.php";  // Ensure the prompts are included

// Start the session to manage chat data
session_start();

// Check if the URL has 'chatting=true'
$chatting = isset($_GET['chatting']) && $_GET['chatting'] === 'true';

// Initialize the session variable for chat history if not set
if (!isset($_SESSION['chatHistory'])) {
    $_SESSION['chatHistory'] = []; // Initialize chat history
}

// Initialize the session variable for chat open state if not set
if (!isset($_SESSION['chatOpen'])) {
    $_SESSION['chatOpen'] = false; // Default to closed on first load
}

// Clear chat history if 'chatting=true' is NOT present in the URL
if (!$chatting) {
    $_SESSION['chatHistory'] = []; // Clear chat history on first load without chatting=true
    $_SESSION['chatOpen'] = false; // Ensure chat window is closed
}

// Clear chat history if the clear button is clicked
if (isset($_POST['clearChat'])) {
    $_SESSION['chatHistory'] = []; // Clear chat history
    $_SESSION['chatOpen'] = false; // Close chat window when chat is cleared
    header("Location: indexnew.php"); // Redirect to avoid form resubmission
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio_file'])) {
    include 'talk.php'; // The audio chat functionality PHP file
    exit;
}

// Check if a message was sent
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userMessage']) && !empty($_POST['userMessage'])) {
    $userMessage = trim($_POST['userMessage']);
    $outputMessage = $userMessage;

    // Insert the user's message into the chat history
    $_SESSION['chatHistory'][] = ['user' => $outputMessage, 'chatbot' => ''];

    // Prepare chat history string to prepend to the prompt
    $chatHistoryString = "";
    foreach ($_SESSION['chatHistory'] as $chat) {
        if (!empty($chat['user'])) {
            $chatHistoryString .= $chat['user'] . "\n";
        }
        if (!empty($chat['chatbot'])) {
            $chatHistoryString .= $chat['chatbot'] . "\n";
        }
    }

    // Inject the prompts and chat history into the message
    $userMessage = $prependText . $chatHistoryString . $userMessage;

    // OpenAI API URL
    $apiUrl = "https://api.openai.com/v1/chat/completions";

    // Prepare the data for the API request
    $postData = [
        "model" => "gpt-4o-mini", 
        "messages" => [
            ["role" => "user", "content" => $userMessage]
        ]
    ];

    // Initialize cURL session
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);

    // Execute cURL request and capture the response
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response
    if ($response) {
        $responseData = json_decode($response, true);
        if (isset($responseData['choices'][0]['message']['content'])) {
            $assistantResponse = $responseData['choices'][0]['message']['content'];
            // Update the chat history with the assistant's response
            $_SESSION['chatHistory'][count($_SESSION['chatHistory']) - 1]['chatbot'] = $assistantResponse;
        }
    }

    // Set chat window to open after sending a message
    $_SESSION['chatOpen'] = true;

    // Redirect to avoid form resubmission and ensure 'chatting=true' is in the URL
    header("Location: indexnew.php?chatting=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic HTML Page</title>
</head>

<body>

    <button class="toggleButton" id="toggleButton">DugBot AI Chat</button>

    <div id="toggleText" style="display: none;">
        <div id="picture">
            <img src="img/Dugwebpic.webp" alt="Chat Header Image" title="" class="chat-header-img">
        </div>
        <div class="form-container">
            <form method="post" action="indexnew.php?chatting=true" style="margin-bottom: 10px;">
                <input type="text" name="userMessage" placeholder="Hello from me...">
                <button type="submit">Send</button>
            </form>
        </div>
        <div class="form-container">
            <form method="post" action="indexnew.php">
                <input type="hidden" name="clearChat" value="true">
                <button type="submit" class="clear-chat-btn">Clear Chat</button>
            </form>
        </div>
        <div class="chat-container">
            <?php if (!empty($_SESSION['chatHistory'])): ?>
            <?php foreach ($_SESSION['chatHistory'] as $message): ?>
            <div class="chat-message user-message chat-text"><?php echo htmlspecialchars($message['user']); ?></div>
            <div class="chat-message assistant-message chat-text"><?php echo htmlspecialchars($message['chatbot']); ?>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="chat-message placeholder-message">...</div>
            <?php endif; ?>
        </div>
        <div>
            <button id="startRecording" onclick="startRecording()">Start Recording</button>
            <button id="stopRecording" onclick="stopRecording()" disabled>Stop Recording</button>
        </div>
        <div id="chatResponse"></div>
        <audio id="audioPlayer" style="display: none;" controls></audio>

    </div>

    <script>
    window.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleButton');
        const toggleText = document.getElementById('toggleText');

        // Check if URL has 'chatting=true'
        const urlParams = new URLSearchParams(window.location.search);
        const isChatting = urlParams.get('chatting') === 'true';

        // If chatting=true in the URL, automatically open the chat
        if (isChatting) {
            toggleText.style.display = 'block';
            toggleButton.textContent = 'Hide Chat';
        }

        // Toggle button to show/hide chat
        toggleButton.addEventListener('click', function() {
            if (toggleText.style.display === 'none') {
                toggleText.style.display = 'block';
                toggleButton.textContent = 'Hide Chat';
            } else {
                toggleText.style.display = 'none';
                toggleButton.textContent = 'Chat to DugBot AI';
            }
        });

        // Function to scroll to the bottom of the chat container
        function scrollToBottom() {
            const chatContainer = document.querySelector('.chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Scroll to the bottom when the page loads
        scrollToBottom();
    });
    </script>

    <script>
    const toggleButton = document.querySelector('.toggleButton');

    // Function to handle the scroll logic
    function handleScroll() {
        const scrollPosition = window.pageYOffset + window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        // Only apply on small screens (less than 900px width)
        if (window.innerWidth < 900) {
            // Appear at the top (when less than 1000px scrolled)
            // Disappear after 1000px scrolled down and reappear near the bottom
            if ((documentHeight - scrollPosition < 800) || (window.scrollY < 600)) {
                toggleButton.style.display = 'block'; // Show the button
            } else {
                toggleButton.style.display = 'none'; // Hide the button
            }
        } else {
            toggleButton.style.display = 'block'; // Always show on larger screens
        }
    }

    // Add event listeners for scroll and resize events
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', handleScroll);
    window.addEventListener('DOMContentLoaded', handleScroll);
    </script>
    <script>
    let mediaRecorder;
    let audioChunks = [];
    let isRecording = false;

    function startRecording() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                audio: true
            }).then((stream) => {
                mediaRecorder = new MediaRecorder(stream);

                mediaRecorder.ondataavailable = function(event) {
                    audioChunks.push(event.data);
                };

                mediaRecorder.start();
                isRecording = true;
                document.getElementById("startRecording").disabled = true;
                document.getElementById("stopRecording").disabled = false;

                setTimeout(() => {
                    if (isRecording) stopRecording();
                }, 10000);
            }).catch(console.error);
        } else {
            console.log("Browser does not support audio recording.");
        }
    }

    function stopRecording() {
        if (isRecording) {
            mediaRecorder.stop();
            isRecording = false;
            document.getElementById("startRecording").disabled = false;
            document.getElementById("stopRecording").disabled = true;

            setTimeout(() => {
                const audioBlob = new Blob(audioChunks, {
                    type: "audio/webm"
                });
                const formData = new FormData();
                formData.append("audio_file", audioBlob, "audio.webm");

                fetch("dugbot.php", {
                        method: "POST",
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        const responseText = data.textResponse || "No response.";
                        const audioUrl = data.audioUrl || "";

                        document.getElementById("chatResponse").innerText = responseText;
                        const audioPlayer = document.getElementById("audioPlayer");
                        if (audioUrl) {
                            audioPlayer.src = audioUrl;
                            audioPlayer.style.display = "block";
                            audioPlayer.play();
                        }
                    })
                    .catch(console.error);
            }, 500);
        }
    }
    </script>


</body>

</html>
