@php
    $methods = [
    'GET'   => 'GET',
    'POST'  => 'POST',
    'PUT'  => 'POST',
    'DELETE'  => 'POST',
];
@endphp
<form class="tablelist-form" id="createCampaignModalForm" autocomplete="off" method="{{ $methods[$method] ?? 'GET'}}" action="{{$action ?? ''}}">
    @csrf
    @method($method ?? 'GET')
    {{ $content ?? ''}}
</form>