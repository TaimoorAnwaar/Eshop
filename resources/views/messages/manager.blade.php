@extends('layouts.app')

@section('title', 'Manager Messages')

@section('content')
<div class="container py-5">
    <h1 class="display-4 mb-4 text-center text-primary">Messages Received</h1>

    @if($messages->isEmpty())
        <p class="lead text-center text-muted">No messages received yet.</p>
    @else
        <div class="list-group shadow-lg" id="messages-list">
            @foreach($messages as $message)
                <div class="list-group-item d-flex justify-content-between align-items-start rounded-lg mb-3 bg-light message-item" id="message-{{ $message->id }}">
                    <div class="d-flex flex-column">
                        <strong class="text-dark">{{ $message->sender->name }}:</strong>
                        <p class="text-muted mb-1">{{ $message->text }}</p>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                    <div>
                        
                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="collapse" data-bs-target="#reply-form-{{ $message->id }}">Reply</button>

                      
                        <div class="collapse mt-2" id="reply-form-{{ $message->id }}">
                            <form action="{{ route('reply.message') }}" method="POST" class="mt-2" id="reply-form-submit-{{ $message->id }}">
                                @csrf
                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                <textarea class="form-control" name="reply_text" rows="3" placeholder="Type your reply" required></textarea>
                                <button type="submit" class="btn btn-success btn-sm mt-2">Send Reply</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('5cb645472ed53274079f', {
        cluster: 'ap2',
        encrypted: true
    });

    
    var channel = pusher.subscribe('chat.manager.' + {{ auth()->id() }});

    
    channel.bind('message.sent', function(data) {
        
        $('#messages-list').prepend('<div class="list-group-item d-flex justify-content-between align-items-start rounded-lg mb-3 bg-light message-item" id="message-' + data.message.id + '">' +
            '<div class="d-flex flex-column"><strong class="text-dark">' + data.message.sender_name + ':</strong>' +
            '<p class="text-muted mb-1">' + data.message.text + '</p>' +
            '<small class="text-muted">Just now</small></div>' +
            '<div><button class="btn btn-outline-info btn-sm">Reply</button></div></div>');
    });

    
    @foreach($messages as $message)
    $('#reply-form-submit-{{ $message->id }}').submit(function(e) {
    e.preventDefault();  

    var replyText = $(this).find('textarea[name="reply_text"]').val();
    var messageId = $(this).find('input[name="message_id"]').val();

    $.ajax({
        url: '{{ route('reply.message') }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
           
            var messageItem = $('#message-' + messageId);
            $('#messages-list').append(messageItem);  

          
            $(this).find('textarea').val('');

            $('#messages-list').scrollTop($('#messages-list')[0].scrollHeight);
        },
        error: function() {
            alert('Failed to send reply.');
        }
    });
});

    @endforeach
</script>

@endsection

@push('styles')
<style>
    .list-group-item {
        border: none;
        border-radius: 12px;
        transition: transform 0.3s ease;  
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
    }

    .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: white;
    }

    .text-primary {
        color: #007bff !important;
    }

    .container {
        max-width: 900px;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    .collapse {
        display: none;
    }

    .collapse.show {
        display: block;
    }
</style>
@endpush
