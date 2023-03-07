<li class="menu-title"><span>Menu</span></li>
@foreach($menu->items as $key => $item)
    @empty($item["children"])
        <li class="nav-item">
            <a class="nav-link menu-link @if($menu->currentKey == $key) active @endif" href="{{ isset($item["route"]) ? route($item["route"]) : '#' }}">
                <i class="{{ $item["icon"] ?? "ri-google-play-line " }}"></i> <span>@lang($item["title"])</span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link menu-link" href="#menu{{ ucfirst($key) }}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="menu{{ ucfirst($key) }}">
                <i class="@lang($item["icon"])"></i> <span>@lang($item["title"])</span>
            </a>
            <div class="collapse menu-dropdown" id="menu{{ ucfirst($key) }}">
                <ul class="nav nav-sm flex-column">
                    @foreach($item["children"] as $subKey => $subMenu)
                        <li class="nav-item">
                            <a href="{{ isset($subMenu["route"]) ? route($subMenu["route"]) : '#' }}" class="nav-link">@lang($subMenu["title"])</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    @endif
@endforeach