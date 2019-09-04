@extends('layouts.app')

@section('content')
<div class="box">
    <form action="{{ route('employees.store') }}" method="POST">
        @include('employees.form',['buttonText'=>'Create employee'])
    </form>
</div>
@endsection