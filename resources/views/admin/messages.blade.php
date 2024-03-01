@extends('layout.app')

@section('title')
    Admin | Messages
@endsection

@section('body')
    <section class="messages">
        <h1 class="title"> messages </h1>
        <div class="box-container">
            @forelse ($messages as $message)
                <div class="box">
                    <p> name : <span>{{ $message->user->name }}</span> </p>
                    <p> email : <span>{{ $message->user->email }}</span> </p>
                    <p> number : <span>{{ $message->phone }}</span> </p>
                    <p> message : <span>{{ $message->message }}</span> </p>

                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" onclick="return alert('delete this message?')" value="delete message"
                            class="delete-btn">
                    </form>
                </div>
            @empty
                <p class="empty">No Messages to Display</p>
            @endforelse
        </div>
    </section>
@endsection
