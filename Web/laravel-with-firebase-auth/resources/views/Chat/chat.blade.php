<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .chat-container {
            width: 600px;
            margin: 50px auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .messages {
            max-height: 400px;
            overflow-y: scroll;
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .message.sent {
            background-color: #d4edda;
        }
        .message.received {
            background-color: #f8d7da;
        }
        .input-area {
            display: flex;
        }
        .input-area input {
            width: 80%;
            padding: 10px;
            margin-right: 10px;
        }
        .input-area button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Chat with {{ $receiverEmail }}</h2>
        <div class="messages" id="messages">
            @foreach ($messages as $message)
                <div class="message {{ $message['senderID'] == auth()->id() ? 'sent' : 'received' }}">
                    <strong>{{ $message['senderEmail'] }}:</strong> {{ $message['message'] }}
                </div>
            @endforeach
        </div>

        <form action="{{ route('send.message') }}" method="POST">
            @csrf
            <div class="input-area">
                <input type="text" name="message" placeholder="Type your message..." required>
                <button type="submit">Send</button>
            </div>
        </form>
    </div>
</body>
</html>
