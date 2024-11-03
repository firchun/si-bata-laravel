<div id="chat-container">
    <div class="py-2 text-center bg-primary font-weight-bold text-white d-flex justify-content-between px-3">
        Live chat
        {{-- <button type="button" class="close text-white" onclick="toggleChatModal()">&times;</button> --}}
    </div>
    <div id="chat-box"></div>
    <div id="input-box">
        <input type="text" id="message" placeholder="Type your message" />
        <button id="send-btn">Send</button>
    </div>
</div>
@push('js')
    <script>
        let receiverId =
            {{ $seller->id_user }}; // Assign the ID of the receiver
        let fetchInterval = 1000;

        // Load messages initially
        loadMessages();

        // Polling to fetch new messages
        setInterval(loadMessages, fetchInterval);

        function loadMessages() {
            $.get('/messages/' + receiverId, function(data) {
                let chatBox = $('#chat-box');
                chatBox.html('');
                data.forEach(function(message) {
                    const senderName = Number(message.sender_id) === {{ Auth::id() }} ?
                        '<span class="sender"> Kamu</span>' :
                        '<span class="admin">Seller</span>';

                    const messageClass = Number(message.sender_id) === {{ Auth::id() }} ?
                        'message-left' :
                        'message-right';
                    const messageHtml = `
                        <div class="message ${messageClass}">
                            <span class="sender-name">${senderName}</span>
                            <div class="message-content">${message.message}</div>
                        </div>`;

                    chatBox.append(messageHtml);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight); // Scroll to bottom
            });
        };

        $('#send-btn').click(function() {
            let message = $('#message').val();
            if (message.trim() !== '') {
                $.post('/send-message', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    receiver_id: receiverId, // Ensure this is defined before use
                    message: message
                }, function(data) {
                    $('#message').val(''); // Clear input
                    loadMessages(); // Load messages after sending
                });
            }
        });
    </script>
@endpush
