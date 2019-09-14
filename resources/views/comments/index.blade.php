@extends('layouts.app')

@section('content')
    <div class="comment-section">
        @can('comments.create',$task)
            <h4 class="title is-5">New Comment</h4>
            @include('comments.create')
        @endcan

        <div class="box">
            <h4 class="title is-5">Comments</h4>
            @forelse($comments as $key => $comment)
                <article class="media">
                    <div class="media-content">
                        <div class="content">
                            <div class="right">
                                @if( Auth::id() === $comment->creator->id )
                                    @can('comments.update',[$task,$comment])
                                        <a href="{{ route('tasks.comments.edit',['task'=>$task->id,'comment'=>$comment->id]) }}"><i style="font-size: 18px;color: #000000" class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('comments.delete',[$task,$comment])
                                        <a href="{{ route('tasks.comments.destroy',['task'=>$task->id,'comment'=>$comment->id]) }}"><i style="font-size: 18px;color: #000000" class="fa fa-trash"></i></a>
                                    @endcan
                                @endif
                            </div>
                            <p>
                                <strong class="members-initial is_{{ ++$key }}">{{ strtoupper(substr($comment->creator->name, 0, 2)) }}</strong>
                                <strong class="project-title">{{ $comment->creator->name }}</strong>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </p>
                            <p>
                                {{ $comment->body }}
                            </p>
                        </div>
                    </div>
                </article>
            <hr />
            @empty
                <div class="box has-text-centered even">
                    No comments.
                </div>
            @endforelse
        </div>
    </div>

    <div class="task-section">
        <h4 class="title is-5">Task details</h4>
        <div class="box project-header">
            <h1 class="title is-4">
                {{ $task->title }}
            </h1>
            <div class="content">
                {{ $task->description }}
            </div>
        </div>

        @if ($user)
            <h4 class="title is-5">Assigned to</h4>
            <strong class="members-initial is_1">{{ strtoupper(substr($user->name, 0, 2)) }}</strong>
            <strong class="project-title">{{ ucfirst($user->name) }}</strong>
        @endif
    </div>
@endsection