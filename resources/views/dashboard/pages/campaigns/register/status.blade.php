@switch($status)
    @case("canceled")
        <span class="badge fs-14 badge-soft-secondary">{{$status}}</span>
        @break
    @case('completed')
        <span class="badge fs-14 badge-soft-success">{{$status}}</span>
        @break
    @default
        <span class="badge fs-14 badge-soft-primary">{{$status}}</span>
@endswitch
