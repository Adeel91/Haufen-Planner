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
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Direct Chat</h3>
                    </div>
                    <div class="box-body">
                        <div class="direct-chat-messages">
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                </div>
                                <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="message user image">
                                <div class="direct-chat-text">
                                    Is this template really for free? That's unbelievable!
                                </div>
                            </div>
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                </div>
                                <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="message user image">
                                <div class="direct-chat-text">
                                    You better believe it!
                                </div>
                            </div>

                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                                </div>
                                <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="message user image">
                                <div class="direct-chat-text">
                                    Working with AdminLTE on a great new app! Wanna join?
                                </div>
                            </div>
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                                </div>
                                <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="message user image">
                                <div class="direct-chat-text">
                                    I would love to.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                        <button type="button" class="btn btn-warning btn-flat">Send</button>
                      </span>
                            </div>
                        </form>
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
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Norman</a>
                                <span class="users-list-date">Yesterday</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user7-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Jane</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user6-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">John</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander</a>
                                <span class="users-list-date">13 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user5-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Sarah</a>
                                <span class="users-list-date">14 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user4-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nora</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
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
        <div class="row oneColumn">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Supervisors</h3>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user7-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Jane</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander</a>
                                <span class="users-list-date">13 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user4-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nora</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user6-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">John</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user5-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Sarah</a>
                                <span class="users-list-date">14 Jan</span>
                            </li>
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('users.index') }}" class="uppercase">View All Supervisors</a>
                    </div>
                </div>
            </div>
        </div>

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