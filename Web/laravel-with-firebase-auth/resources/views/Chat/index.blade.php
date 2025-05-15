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
                            $('textarea[name="message"]').val('');
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
            }

            .containerss {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }



            .messages-wrapper {
                max-height: 400px;
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
                background-color: #4A90E2;
                color: #fff;
            }

            .message:not(.current-user) .message-content {
                background-color: #F0F4F8;
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
                color: #9B9B9B;
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
        </style>
    </head>

    <body>
        <div class="bodyss">
            <div class="containerss">
                <h1 class="Judul">Obrolan dengan</h1> <strong>{{ $receiver->username }}</strong>

                <div class="messages-wrapper">
                    <div class="messages">
                        @foreach ($messages as $message)
                            <div
                                class="message {{ $message->sender_email == auth()->user()->email ? 'current-user' : '' }}">
                                <div class="message-content">
                                    <strong>{{ $message->sender_email == auth()->user()->email ? 'You' : $message->sender_email }}:</strong>
                                    <p>{{ $message->message }}</p>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form action="{{ url('/obrolan/send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="receiver_email" value="{{ $receiver->email }}">
                    <textarea name="message" placeholder="Tulis pesan" required></textarea>
                    <button type="submit">Kirim</button>
                </form>
            </div>
        </div>
        @if ($receiver->username != 'Super Admin')
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
