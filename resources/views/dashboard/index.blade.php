@extends('layouts.app')

@section('content')
    <h2 class="title is-5">
        Projects overview
    </h2>
    @forelse($projectGroupCounts->chunk(5) as $chunk)
        <div class="columns">
            @foreach($chunk as $projectGroup)
                <div class="column is-one-fifth">
                    <a href="{{ route('projects.index', ['status'=>$projectGroup->slug]) }}">
                        <div class="box has-text-centered {{ (
                            ($projectGroup->slug === 'open') ? 'bg-open' :
                            (($projectGroup->slug === 'draft') ? 'bg-draft' :
                            (($projectGroup->slug === 'on-going') ? 'bg-ongoing' :
                            (($projectGroup->slug === 'cancel') ? 'bg-cancel' :
                            'bg-close')))
                        ) }}">
                            <div class="title is-5">
                                {{ $projectGroup->title }}
                            </div>
                            <div class="subtitle is-2">
                                {{ $projectGroup->count }}
                            </div>
                            <p class="more-detail">
                                More Detail
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @empty
        <p class="has-text-centered">
            No projects yet.
        </p>
    @endforelse

    <div class="sectionDash">
        <div>
            <h2 class="title is-5">
                Chat members
            </h2>
        </div>

        <div class="clock">
            <div id="myclock"></div>
        </div>
    </div>
@endsection