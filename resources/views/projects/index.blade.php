@extends('layouts.app')

@section('content')
    <div class="level">
        <div class="level-left">
            <a href="{{ route('projects.index') }}" class="level-item filter-options bg-all">All</a>
            @foreach($statuses as $status)
                <a href="{{ route('projects.index',['status'=>$status->slug]) }}" class="level-item filter-options {{ (
                    ($status->slug === 'open') ? 'bg-open' :
                    (($status->slug === 'draft') ? 'bg-draft' :
                    (($status->slug === 'on-going') ? 'bg-ongoing' :
                    (($status->slug === 'cancel') ? 'bg-cancel' :
                    'bg-close')))
                ) }}">
                    {{ $status->title }}
                </a>
            @endforeach
        </div>
        <div class="level-right">
            @can('projects.create')
                <a href="{{ route('projects.create') }}" class="level-item button is-success">New Project</a>
            @endcan
        </div>
    </div>
    {{ $table->display() }}
@endsection