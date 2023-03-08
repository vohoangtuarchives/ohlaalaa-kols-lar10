<div>
    <div class="row my-3">
        <div class="col-md-4  mb-3">
            <label class="form-label">Tỉnh Thành</label>
            <select wire:model="city" name="city"  wire:click="city($event.target.value)" class="form-select">
                <option selected>Chọn Tỉnh Thành</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}" @if(old('city') == $city->id) selected @endif>{{$city->title}}</option>
                @endforeach
            </select>
            <input type="hidden" name="city_name" wire:model="city_name">
        </div>
        <div class="col-md-4  mb-3">
            <label class="form-label">Quận Huyện</label>
            <select wire:model="district" name="district" wire:click="district($event.target.value)" class="form-select">
                <option selected>Chọn Quận Huyện</option>
                    @foreach($districts as $district)
                        <option value="{{$district->id}}"  @if(old('district') == $district->id) selected @endif>{{$district->title}}</option>
                    @endforeach
            </select>
            <input type="hidden" name="district_name" wire:model="district_name">
        </div>
        <div class="col-md-4  mb-3">
            <label class="form-label">Phường Xã</label>
            <select wire:model="ward" name="ward" class="form-select" wire:click="ward($event.target.value)">
                <option selected>Chọn Phường Xã</option>
                @foreach($wards as $ward)
                    <option value="{{$ward->id}}"  @if(old('ward') == $ward->id) selected @endif>{{$ward->title}}</option>
                @endforeach
            </select>
            <input type="hidden" name="ward_name" wire:model="ward_name">
        </div>
        <div class="col-md-12 mb-3">
            <label for="">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ $address ?? '' }}">
        </div>
    </div>
</div>
