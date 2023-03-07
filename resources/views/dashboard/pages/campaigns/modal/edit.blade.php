<x-form :method="'PUT'">
    <x-slot name="action">
        {{ route("dashboard.campaigns.update", [
    'id' => $item->id
]) }}
    </x-slot>
    <x-slot name="content">
        <x-admin.modal>
            <x-slot name="id">
                showUpdateModal
            </x-slot>
            <x-slot name="content">
                <x-admin.input :id="'inputCampaignTitle'" :type="'text'" :name="'title'" :required="'required'">
                    <x-slot name="label">
                        {{ __("admin.pages.campaigns.input-title") }}
                    </x-slot>
                    <x-slot name="value">
                        {{ $item->title ?? '' }}
                    </x-slot>
                </x-admin.input>
                <x-admin.input :id="'inputCampaignAmount'" :type="'text'" :name="'amount'" >
                    <x-slot name="label">
                        {{ __("admin.pages.campaigns.input-amount") }}
                    </x-slot>
                    <x-slot name="value">
                        {{ $item->amount ?? 0 }}
                    </x-slot>
                    <x-slot name="with">
                        {{ __("admin.pages.currency") }}
                    </x-slot>
                    <x-slot name="event">
                        x-mask:dynamic="$money($input, '.', ' ')"
                    </x-slot>
                </x-admin.input>
                <x-select :id="'inputCampaignRebateLevels'"  :name="'rebate_levels'" :class="'d-none'">
                    <x-slot name="label">
                        {{ __("admin.pages.campaigns.rebate_levels") }}
                    </x-slot>
                    <x-slot name="options">
                        @foreach([0,1,2,3,4,5,6,7,8,9,10] as $option)
                            <option value="{{ $option }}" @if($option == $item->rebate_levels) selected @endif>{{ $option }}</option>
                        @endforeach
                    </x-slot>
                </x-select>
                @foreach([1,2,3] as $level)
                    <x-admin.input :id="'inputCampaignRebateLevels'" :type="'number'">
                        <x-slot name="name">
                            level[{{$level}}]
                        </x-slot>
                        <x-slot name="label">
                            Level {{ $level }}
                        </x-slot>
                        <x-slot name="value">
                            {{ $item->currentRebate()->{"level_$level"} ?? 0 }}
                        </x-slot>
                        <x-slot name="with">
                            %
                        </x-slot>
                    </x-admin.input>
                @endforeach
            </x-slot>
        </x-admin.modal>
    </x-slot>
</x-form>