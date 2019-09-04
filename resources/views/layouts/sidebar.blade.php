<aside class="menu">
    <p class="menu-label">
        General
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('dashboard') }}" href="{{ route('dashboard') }}">
                <span class="icon"><i class="fa fa-home"></i></span>
                Dashboard
            </a>
        </li>
        @role('admin')
        <li>
            <a class="{{ isActive('employees.index') }}" href="{{ route('employees.index') }}">
                <span class="icon"><i class="fa fa-users"></i></span>
                Employees
            </a>
        </li>
        <li>
            <a class="{{ isActive('users.index') }}" href="{{ route('users.index') }}">
                <span class="icon"><i class="fa fa-users"></i></span>
                Supervisors
            </a>
        </li>
        @endrole
    </ul>
    <p class="menu-label">
        Project
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('projects.index') }}" href="{{ route('projects.index') }}">
                <span class="icon"><i class="fa fa-tasks"></i></span>
                Projects
            </a>
        </li>
        <li>
            <a class="{{ isActive('projects.create') }}" href="{{ route('projects.create') }}">
                <span class="icon"><i class="fa fa-plus-circle"></i></span>New Project
            </a>
        </li>
    </ul>
    @role('admin')
    <p class="menu-label">
        Status
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('statuses.index') }}" href="{{ route('statuses.index') }}">
                <span class="icon"><i class="fa fa-info-circle"></i></span>
                Statuses
            </a>
        </li>
        <li>
            <a class="{{ isActive('statuses.create') }}" href="{{ route('statuses.create') }}">
                <span class="icon"><i class="fa fa-plus-circle"></i></span>
                New Status
            </a>
        </li>
    </ul>
    <p class="menu-label">
        User
    </p>
    <ul class="menu-list">
        <li>
            <a class="{{ isActive('employees.create') }}" href="{{ route('employees.create') }}">
                <span class="icon"><i class="fa fa-plus-circle"></i></span>
                New Employee
            </a>
        </li>
        <li>
            <a class="{{ isActive('users.create') }}" href="{{ route('users.create') }}">
                <span class="icon"><i class="fa fa-plus-circle"></i></span>
                New Supervisor
            </a>
        </li>
    </ul>
    @endrole
</aside>