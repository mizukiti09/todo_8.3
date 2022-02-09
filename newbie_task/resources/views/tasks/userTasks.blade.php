@extends('layouts.app') @section('content') @include('parts.header')

<span class="topText">
  {{ $group_name }}：
  {{ $userName }}
</span>
<div id="app">
    <user-tasks-component :not_decided="{{ $not_decided }}" :decided="{{ $decided}}" :done="{{ $done }}" :auth_user_id="{{ $auth_user_id }}" :group_id="{{ $group_id }}"></user-tasks-component>
</div>

@endsection