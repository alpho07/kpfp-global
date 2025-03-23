@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Inbox
        </div>



        <div class="" id="messagingModal" tabindex="-1" role="dialog" aria-labelledby="messagingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messagingModalLabel">Messaging with
                            <b>{{ Str::ucfirst($users->name) }} {{ date('m-d-Y') }}</b>
                        </h5>

                    </div>
                    <form action="{{ route('messaging.save', [$new_sender, $new_receiver]) }}" method="post">
                        <div class="modal-body">

                            {{ @csrf_field() }}

                            <!-- List of Messages -->
                            <div class="" style="">
                                <ul class="list-group">
                                    @foreach ($message as $m)
                                        <li class="list-group-item">
                                            @php
                                                $users->name;
                                            @endphp
                                            <p>
                                                <b>{{ App\User::where('id',$m->user)->first()->name ?? $m->user}}   {{' - ' . $m->created_at }}</b>
                                            </p>
                                            {{ $m->message }}
                                        </li>
                                    @endforeach
                                    <!-- Add more messages dynamically -->
                                </ul>
                            </div>

                            <!-- Textarea for Typing a New Message -->
                            <div class="form-group mt-3">

                                <textarea class="form-control" name="message" placeholder="Type Message ..." required rows="2"></textarea>
                            </div>
                            <div class="modal-footer">
                                <!-- Buttons for Sending or Closing the Modal -->
                                <input type="submit" class="btn btn-primary" value="Send message">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var textarea = document.querySelector('textarea[name="message"]');
            var wordCountDisplay = document.createElement('p');
            wordCountDisplay.textContent = 'Words remaining: 50';
            textarea.parentNode.insertBefore(wordCountDisplay, textarea.nextSibling);

            textarea.addEventListener('input', function() {
                var words = textarea.value.split(/\s+/).filter(function(word) {
                    return word.length > 0;
                });
                var remainingWords = 50 - words.length;

                if (remainingWords >= 0) {
                    wordCountDisplay.textContent = 'Words remaining: ' + remainingWords;
                } else {
                    textarea.value = words.slice(0, 50).join(' ');
                    wordCountDisplay.textContent = 'Words remaining: 0';
                }
            });
        });
    </script>
@endsection
