{{-- For submenu --}}
<ul class="menu-content">
    @foreach($menu as $submenu)
    <?php
            $submenuTranslation = "";
            if(isset($submenu->i18n)){
                $submenuTranslation = $submenu->i18n;
            }
        ?>
        @if(Route::has($submenu->url))
            <li class="{{ (request()->routeIs($submenu->url)) ? 'active' : '' }}">
                <a href="{{ route($submenu->url) }}">
                    <i class="{{ isset($submenu->icon) ? $submenu->icon : "" }}"></i>
                    <span class="menu-title" data-i18n="{{ $submenuTranslation }}">{{ __($submenu->name) }}</span>
                </a>
                @if (isset($submenu->submenu))
                    @include(get_layout('panels/submenu'), ['menu' => $submenu->submenu])
                @endif
            </li>
        @endif
    @endforeach
</ul>
