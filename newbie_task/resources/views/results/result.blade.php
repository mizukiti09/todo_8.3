@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 max-width">
            <div class="card">
                <div class="card-header"><span class="page-title">完了タスク月間表</span> @include('parts.header')
                </div>
                <div class="list-group">

                    @php $now_route = \Route::currentRouteName(); @endphp @if ($now_route == 'result') @foreach ($results as $result)
                    <a href="{{ route('day', ['yearMonth' => $result->regist_time]) }}" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $result->regist_time }}</h5>
                            <small>{{ $result->count }}件</small>
                        </div>
                    </a>
                    @endforeach @elseif ($now_route == 'group_result') @foreach ($results as $result)
                    <a href="{{ route('group_day', ['yearMonth' => $result->regist_time]) }}" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $result->regist_time }}</h5>
                            <small>{{ $result->count }}件</small>
                        </div>
                    </a>
                    @endforeach @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection