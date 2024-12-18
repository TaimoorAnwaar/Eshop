{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Chat with Manager
                </div>
                <div class="card-body" id="messages-container">
                    <!-- Messages will appear here -->
                    <div id="messages"></div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('send.message') }}" method="POST">
                        @csrf
                        <input type="text" name="text" id="message" placeholder="Type a message" required>
                        <input type="hidden" name="receiver_id" value="1">  <!-- Set receiver_id dynamically -->
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    // Initialize Pusher
    var pusher = new Pusher('PUSHER_APP_KEY', {
    cluster: 'mt1'
});


    // Subscribe to the channel
    var channel = pusher.subscribe('chat.' + {{ auth()->id() }}); // subscribe to the current user's channel
    channel.bind('message.sent', function(data) {
        // Append the new message to the chat window
        $('#messages').append('<div><strong>' + data.message.sender_name + ':</strong> ' + data.message.text + '</div>');
    });

    // Handle form submission to send a message
    $('#message-form').submit(function(event) {
        event.preventDefault();
        
        var messageText = $('#message').val();
        var receiverId = 1; // Set this to the manager's user ID

        $.ajax({
            url: '/send-message',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                receiver_id: receiverId,
                text: messageText
            },
            success: function(response) {
                // Clear the message input field
                $('#message').val('');
            },
            error: function() {
                alert('Failed to send message.');
            }
        });
    });
</script>
@endpush --}}
