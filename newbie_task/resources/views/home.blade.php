@extends('layouts.app') @section('content') @include('parts.header') @if (request()->path() == 'group')
<span class="topText">
    {{ $group_name }}
  </span> @endif
<div id="app">
    <company-slide-component :img1="{{ json_encode($group_img1)}}" :img2="{{ json_encode($group_img2)}}" :img3="{{ json_encode($group_img3)}}"></company-slide-component>
</div>
<div class="newbie-taskList">
    <ol class="list-group list-group-numbered">
        @foreach ($newbie_tasks as $newbie)
        <a href="{{ route('userTasks', ['user_id' => $newbie->id]) }}">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $newbie->name }}</div>
                </div>
                <span class="badge bg-danger rounded-pill">{{ $newbie->未確定 }}</span>
                <span class="badge bg-warning rounded-pill">{{ $newbie->確定 }}</span>
                <span class="badge bg-primary rounded-pill">{{ $newbie->完了 }}</span>
            </li>
        </a>
        @endforeach
    </ol>
</div>
@endsection