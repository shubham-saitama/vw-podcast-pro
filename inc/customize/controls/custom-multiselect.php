<?php
class vw_podcast_pro_Multiselect_Control extends WP_Customize_Control {
    public $type = 'multiselect';

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <select multiple="multiple" <?php $this->link(); ?>>
                <?php
                foreach ($this->choices as $value => $label) {
                    $selected = in_array($value, $this->value()) ? 'selected="selected"' : '';
                    echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
                }
                ?>
            </select>
        </label>
        <?php
    }
}