@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Obrolan</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Polling function to get new messages every 3 seconds
                function fetchMessages() {
                    let receiverEmail = "{{ $receiver->email }}";
                    let senderEmail = "{{ auth()->user()->email }}";
                    // Fetch the latest messages using AJAX
                    $.ajax({
                        url: "{{ route('chat', ['userEmail' => $receiver->email]) }}",
                        type: 'GET',
                        data: {
                            sender_email: senderEmail,
                            receiver_email: receiverEmail
                        },
                        success: function(data) {
                            // Replace the message list with the new content
                            $('div.messages').html(data.messages);
                            // Scroll to the bottom after new messages are fetched
                            $(".messages-wrapper").scrollTop($(".messages-wrapper")[0].scrollHeight);
                        }
                    });
                }

                // Poll every 3 seconds to refresh the messages
                setInterval(fetchMessages, 3000);

                // Send message using AJAX
                $('form').on('submit', function(e) {
                    e.preventDefault();
                    // Send the message asynchronously
                    $.ajax({
                        url: "{{ url('/obrolan/send') }}",
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Clear the message input
                            $('input[name="message"]').val('');

                            // After sending the message, we fetch the updated messages
                            fetchMessages();
                        }
                    });
                });
            });
        </script>
        <style>
            .bodyss {
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
                color: #333;
                background-color: #f3f2f3;
                border-radius: 20px;
                min-height: 800px;

            }

            .containerss {

                max-width: 100%;
                margin: 0 auto;
                padding: 20px;
                min-height: 800px;
                max-height: 800px;
                border-radius: 20px;
            }

            .messages-wrapper {
                border-radius: 20px;
                max-height: 100%;
                max-height: 600px;
                overflow-y: auto;
                margin-bottom: 20px;
                padding-right: 10px;
            }

            .messages {
                background-color: #fff;
                border-radius: 8px;
                padding: 20px;
            }

            .message {
                display: flex;
                margin-bottom: 10px;
            }

            .message.current-user {
                justify-content: flex-end;
            }

            .message .message-content {
                max-width: 60%;
                padding: 10px;
                border-radius: 8px;
                font-size: 16px;
            }

            .message.current-user .message-content {
                background-color: #AE7EE9;
                color: #fff;
            }

            .message:not(.current-user) .message-content {
                background-color: #e0effd;
            }

            .message strong {
                font-size: 16px;
                margin-bottom: 5px;
            }

            .message p {
                margin: 0;
                font-size: 16px;
            }

            .message small {
                color: #cac6c6;
                font-size: 14px;
            }

            form {
                background-color: #fff;
                border-radius: 8px;
                padding: 10px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            form textarea {
                flex-grow: 1;
                border: 1px solid #D8D8D8;
                border-radius: 4px;
                padding: 10px;
                font-size: 16px;
                resize: none;
                min-height: 40px;
            }

            form button {
                background-color: #4A90E2;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            form button:hover {
                background-color: #3A7DB7;
            }

            .receiver-username {
                font-size: 40px;
                font-weight: bold;


            }

            img {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                object-fit: cover;
            }

            .profile-container {
                display: flex;
                align-items: center;

                gap: 5px;
            }

            .forms {
                background-color: #fff;
                border-radius: 8px;
                padding: 10px;
                display: flex;
                align-items: center;
                gap: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .inputs[type="text"] {
                flex-grow: 1;
                border: 1px solid #D8D8D8;
                border-radius: 4px;
                padding: 10px;
                font-size: 16px;
                min-height: 40px;
                outline: none;
                transition: border-color 0.3s;
            }
            .buttons {
                background-color: #4A90E2;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .buttons:hover {
                background-color: #3A7DB7;
            }
        </style>
    </head>

    <body>
        <br><br>
        <div class="bodyss">
            <div class="containerss">
                <div class="profile-container">
                    <img src="{{ asset($receiver->image ?? 'images/default-avatar.jpg') }}" alt="Profile Picture">
                    <strong class="receiver-username">{{ $receiver->username }}</strong>
                </div>
                <div class="messages-wrapper">
                    <div class="messages">
                        @foreach ($messages as $message)
                            <div
                                class="message {{ $message->sender_email == auth()->user()->email ? 'current-user' : '' }}">
                                <div class="message-content">
                                    <p>{{ $message->message }}</p>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form class="forms" action="{{ url('/obrolan/send') }}" method="POST">
                    @csrf
                    <input class="inputs" type="hidden" name="receiver_email" value="{{ $receiver->email }}">
                    <input type="text" class="inputs" name="message" placeholder="Tulis pesan" required>
                    <button class="buttons" type="submit">Kirim</button>
                </form>

            </div>
        </div>
        @if ($receiver->username != 'Admin' && Auth::user()->email != 'admin@gmail.com')
            <p>Selesai Melakukan Negosiasi?</p>
            <br>
            <p>Chat dengan admin <a href="{{ route('chat', ['userEmail' => 'admin@gmail.com']) }}"
                    class="chat-button">disini</a></p>
            <style>
                .chat-button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: yellow;
                    /* Warna tombol kuning */
                    color: black;
                    /* Warna teks */
                    text-decoration: none;
                    /* Menghapus garis bawah pada tautan */
                    border-radius: 5px;
                    /* Sudut melengkung */
                    font-weight: bold;
                    /* Teks tebal */
                    transition: background-color 0.3s;
                    /* Efek transisi */
                }

                .chat-button:hover {
                    background-color: gold;
                    /* Warna saat hover */
                }
            </style>
        @endif

    </body>
@endsection
