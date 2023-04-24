@if ($post->comments->count() > 0)
    @foreach ($comments as $comment)
        <!-- Single comment-->
        <div class="d-flex comment">
            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                    alt="..."></div>
            <div class="ms-3">
                <div class="fw-bold">
                    {{ $comment->user->name . ' ' . $comment->user->surname }}
                    <small>
                        ({{$comment->user->email}})
                    </small>
                    <small class="text-muted">
                        {{ $comment->created_at->diffForHumans() }}
                    </small>
                </div>
                <small></small>
                {{ $comment->message }}
            </div>
        </div>
    @endforeach
@endif
