@extends('layouts.app') @section('content') @include('parts.header')
<span class="topText">
  集計年月：
  {{ $yearMonth }}
</span>
<div id="app">

    <user-tasks-component :results="{{ json_encode($results) }}" :auth_user_id="{{ $auth_user_id }}" :group_id="{{ $group_id }}" :yearMonth={{$yearMonth}}></user-tasks-component>
</div>
@endsection