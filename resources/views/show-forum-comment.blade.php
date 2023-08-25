@extends('./layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p><b>{{ $forums->title }}</b></p>
                    <p>
                        {{ $forums->body }}
                    </p>
                    <hr />
                    <h4>Display Comments</h4>
                    @foreach($comments as $comments)
                        <div class="display-comment">
                            <strong>{{ $comments->fname }}</strong>
                            <p>{{ $comments->comment_body }}</p>
                        </div>
                    @endforeach
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="forum_id" value="{{ $forums->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection