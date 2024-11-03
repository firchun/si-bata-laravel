<!DOCTYPE html>

<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'home' }} - {{ env('APP_NAME') }}</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="godocs" />

    <!-- ** Plugins Needed for the Project ** -->
    <!-- plugins -->
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/plugins/themify-icons/themify-icons.css">
    <!-- Main Stylesheet -->
    <link href="{{ asset('frontend_theme') }}/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('img') }}/logo.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('img') }}/logo.png" type="image/x-icon">
    @stack('css')
    {{-- style chat --}}
    <style>
        .chat-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
        }

        .chat-button .btn {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.46);
        }

        .chat-button .btn:hover {
            background-color: #004692;
        }
    </style>
    <style>
        .chat-modal {
            position: fixed;
            bottom: 130px;
            right: 50px;
            width: 90vh;
            max-width: 500px;
            height: 60vh;
            z-index: 9999;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
        }


        #chat-container {
            min-width: 50%;
            /* max-width: 80%; */
            height: 60vh;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #chat-box {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Style untuk pesan */
        .message {
            max-width: 70%;
            padding: 10px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.4;
            margin: 5px 0;
        }

        .message-left {
            align-self: flex-start;
            background-color: #e1f5fe;
            color: #0d47a1;
            border-radius: 15px 15px 15px 5px;
        }

        .message-right {
            align-self: flex-end;
            background-color: #ffe0b2;
            color: #e65100;
            text-align: right;
            border-radius: 15px 15px 5px 15px;
        }

        /* Nama pengirim */
        .sender-name {
            font-weight: bold;
            color: #000000;
        }

        /* Input box styling */
        #input-box {
            padding: 10px;
            display: flex;
            align-items: center;
            border-top: 1px solid #ddd;
            background-color: #ffffff;
        }

        #message {
            flex-grow: 1;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }

        #send-btn {
            margin-left: 10px;
            padding: 10px 20px;
            font-size: 14px;
            background-color: #FF0043;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        #send-btn:hover {
            background-color: #c10033;
        }
    </style>
</head>

<body>

    @include('layouts.frontend.navbar')
    @if (Session::has('success'))
        <div class="container mt-5">

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @elseif (Session::has('danger'))
        <div class="container mt-5">

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="container mt-5">

            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach ($errors->all() as $item)
                    <ul>
                        <li>{{ $item }}</li>
                    </ul>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    @yield('content')
    {{-- <!-- Tombol Chat -->
    <div class="chat-button">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary text-white">
                <i class="ti-panel"></i>
            </a>
        @else
            <a href="javascript:void(0)" class="btn btn-primary text-white" onclick="toggleChatModal()">
                <i class="ti-panel"></i>
            </a>
        @endguest
    </div> --}}
    {{-- @guest
    @else
        <!-- Modal Chat -->
        <div id="chatModal" class="chat-modal" style="display: none;">
            @include('pages._chat')
        </div>
    @endguest --}}
    @include('layouts.frontend.footer')


    <!-- plugins -->
    <script src="{{ asset('frontend_theme') }}/plugins/jQuery/jquery.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/masonry/masonry.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/clipboard/clipboard.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/match-height/jquery.matchHeight-min.js"></script>
    @stack('js')
    <!-- Main Script -->
    <script src="{{ asset('frontend_theme') }}/js/script.js"></script>
    <script>
        function toggleChatModal() {
            const chatModal = document.getElementById("chatModal");
            chatModal.style.display = chatModal.style.display === "none" ? "flex" : "none";
        }

        function sendMessage() {
            const message = document.getElementById("message").value;
            if (message.trim() !== "") {
                // Function to send the message here
                document.getElementById("message").value = ""; // Clear input field
            }
        }
    </script>
</body>

</html>
