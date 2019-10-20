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
        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Supervisors</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <li>
                                <img src = "{{ asset('/images/Faisal.jpg') }}" class="Faisal" />
                                <a class="users-list-name" href="#">Faisal</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Nadeem.png') }}" class="Nadeem" />
                                <a class="users-list-name" href="#">Nadeem</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Nabeel.jpg') }}" class="Nabeel" />
                                <a class="users-list-name" href="#">Nabeel</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Adeel.jpg') }}" class="Adeel" />
                                <a class="users-list-name" href="#">Adeel</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('users.index') }}" class="uppercase">View All Supervisors</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Team Members</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <li>
                                <img src = "{{ asset('/images/Sajeel.jpg') }}" class="Sajeel" />
                                <a class="users-list-name" href="#">Sajeel</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Usama.png') }}" class="Usama" />
                                <a class="users-list-name" href="#">Usama</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Mannan.png') }}" class="Mannan" />
                                <a class="users-list-name" href="#">Mannan</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Anas.png') }}" class="Anas" />
                                <a class="users-list-name" href="#">Anas</a>
                            </li>
                            <li>
                                <img src = "{{ asset('/images/Arbaz.png') }}" class="Arbaz" />
                                <a class="users-list-name" href="#">Arbaz</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('employees.index') }}" class="uppercase">View All Team Members</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="clock">
                <div id="myclock"></div>
            </div>
        </div>
    </div>

    <div class="sectionDash">
        <div class="row twoColumns">
            <div class="col-md-6">
                @if (!$tasks->isEmpty())
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">10 Most Recent Tasks</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Task Title</th>
                                            <th>Description</th>
                                            <th>Project</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td><a href="{{ route('tasks.comments.index', $task->id) }}">{{ $task->taskTitle }}</a></td>
                                                <td>{{ $task->description }}</td>
                                                <td>{{ $task->projectTitle }}</td>
                                                <td><a href="{{ route('projects.tasks.index',['project'=>$task->project_id, 'status'=>$task->slug]) }}" class="label-task {{ (
                                                    ($task->slug === 'open') ? 'bg-open' :
                                                    (($task->slug === 'draft') ? 'bg-draft' :
                                                    (($task->slug === 'on-going') ? 'bg-ongoing' :
                                                    (($task->slug === 'cancel') ? 'bg-cancel' :
                                                    'bg-close')))
                                                ) }}">{{ $task->slug }}</a></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $task->due_date }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection