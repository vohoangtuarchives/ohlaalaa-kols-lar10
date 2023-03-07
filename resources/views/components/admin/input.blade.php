<div class="mb-3">
    @isset($label)<label for="{{$id}}-field" class="form-label">{{$label}}</label>@endisset
    <div class="input-group">
        <input type="{{$type}}"
               name="{{$name}}"
               id="{{$id}}-field"
               class="form-control"
               placeholder="{{ $placeholder ?? '' }}"
               {{$event ?? ''}} {{$required ?? ''}}
        @isset($value) value="{{$value}}" @endisset
               />
        @isset($with)
            <span class="input-group-text">{{ $with }}</span>
        @endisset
        <div class="invalid-feedback">{{ $error ?? '' }}.</div>
    </div>
</div>