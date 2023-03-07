<div class="mb-3 {{ $class ?? '' }}">
    <label for="{{$id}}-field" class="form-label">{{ $label }}</label>
    <select class="form-control" data-trigger name="{{$name}}" id="{{$id}}-field" {{$event ?? ''}} required>
        {{ $options ?? '' }}
    </select>
</div>