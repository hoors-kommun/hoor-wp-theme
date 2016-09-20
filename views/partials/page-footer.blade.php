<?php do_action('customer-feedback'); ?>

<footer class="c-page-footer">
    <div class="c-article-timestamps">
        @include('partials.timestamps')
    </div>


    @if (get_field('show_share', get_the_id()) !== false && get_field('page_show_share', 'option') !== false)
    <div class="c-share hidden-print clearfix">

        <p class="c-share__title" id="social-share"><strong><?php _e('Share the page', 'municipio'); ?>:</strong> {{ the_title() }}</p>
        @include('partials.social-share')

    </div>
    @endif
</footer>