<div class="container">
    <div class="grid">
        <div class="grid-xs-12 grid-sm-3 site-header__logotype">
            {!! municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option'), true, get_field('header_tagline_enable', 'option')) !!}
        </div>
        <div class="grid-xs-12 grid-sm-9 hidden-print">
            {!!
                wp_nav_menu(array(
                    'theme_location' => 'help-menu',
                    'container' => 'nav',
                    'container_class' => 'menu-help',
                    'container_id' => '',
                    'menu_class' => 'nav nav-help nav-horizontal',
                    'menu_id' => 'help-menu-top',
                    'echo' => 'echo',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'depth' => 1,
                    'fallback_cb' => '__return_false'
                ));
            !!}
        </div>
    </div>
</div>

@if (get_field('nav_primary_enable', 'option') === true)
    <nav class="primary-navigation hidden-print">
        <div class="container">
            {!! $navigation['mainMenu'] !!}
        </div>
    </nav>
@endif

<div class="search-top header__search hidden-print" id="header-search">
    <div class="container">
        <div class="grid">
            <div class="grid-sm-12">
                @include('partials.search.top-search')
            </div>
        </div>
    </div>
</div>
