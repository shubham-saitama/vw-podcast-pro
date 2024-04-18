<?php
/**
 * The template for displaying search forms in vw-podcast-pro
 *
 * @package vw-podcast-pro
 */
?>
<form role="search" method="get" class="search-form serach-page" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'vw-podcast-pro'); ?>"
            value="<?php echo esc_attr(the_search_query()); ?>" name="s">
    </lab
</form>