<?php

/*
Plugin Name: PawBoost Lost and Found Pets
Plugin URI: https://www.pawboost.com/plugins/pawboost_lfdb.zip
Description: The PawBoost Lost and Found Pets plugin allows you to display a list of lost & found pets as a widget on your WordPress site.
Author: PawBoost
Version: 1.0
Author URI: https://www.pawboost.com
*/

class pb_lfdb_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'pb_lfdb_widget',
            'description' => __('A widget to display the Pawboost Lost and Found Database'),
        );
        parent::__construct('lfdb', __('PawBoost Lost and Found Pets'), $widget_ops);
    }

    function widget($args, $instance) {

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
        <iframe width="100%" frameBorder="0" height="<?php echo $instance['height']; ?>" src="https://www.pawboost.com/frame/lost-found-widget?LfdbFeedStatusForm[zip]=<?php echo $instance['zip'];?>&LfdbFeedStatusForm[radius]=<?php echo $instance['radius'];?>&LfdbFeedStatusForm[species]=<?php echo $instance['species'];?>&LfdbFeedStatusForm[sortAttribute]=<?php echo $instance['sort'];?>&LfdbFeedStatusForm[dateRange]=<?php echo $instance['dateRange'];?>&per-page=<?php echo $instance['perPage'];?>&wp=1&hpb=<?php echo $instance['optIn']; ?>"></iframe>
        <?php echo $args['after_widget'];
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']     = $new_instance['title'];
        $instance['zip']       = $new_instance['zip'];
        $instance['radius']    = $new_instance['radius'];
        $instance['species']   = $new_instance['species'];
        $instance['sort']      = $new_instance['sort'];
        $instance['dateRange'] = $new_instance['dateRange'];
        $instance['perPage']   = $new_instance['perPage'];
        $instance['height']    = $new_instance['height'];
        $instance['optIn']     = $new_instance['optIn'];
        return $instance;
    }

    function form($instance) {

        // create form
        $title       = ! empty($instance['title'])?esc_attr($instance['title']):'';
        $zip         = ! empty($instance['zip'])?esc_attr($instance['zip']):'';
        $radius      = ! empty($instance['radius'])?esc_attr($instance['radius']):'';
        $species     = ! empty($instance['species'])?esc_attr($instance['species']):'';
        $dateRange   = ! empty($instance['dateRange'])?esc_attr($instance['dateRange']):'';
        $sort        = ! empty($instance['sort'])?esc_attr($instance['sort']):'';
        $perPage     = ! empty($instance['perPage'])?esc_attr($instance['perPage']):'';
        $height      = ! empty($instance['height'])?esc_attr($instance['height']):'700px';
        $optIn       = ! empty($instance['optIn'])?esc_attr($instance['optIn']):'1';

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'pb_lfdb_widget'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e('Zip Code', 'pb_lfdb_widget'); ?></label>
            <input id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('radius'); ?>"><?php _e('Search Radius', 'pb_lfdb_widget'); ?></label>
            <input id="<?php echo $this->get_field_id('radius'); ?>" name="<?php echo $this->get_field_name('radius'); ?>" type="text" value="<?php echo $radius; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('species'); ?>"><?php _e('Species', 'pb_lfdb_widget'); ?></label>
            <select name="<?php echo $this->get_field_name('species'); ?>" id="<?php echo $this->get_field_id('species'); ?>" type="text">
                <option value="" <?php echo ($species=='')?'selected':''; ?>>All Species</option>
                <option value="Dog" <?php echo ($species=='Dog')?'selected':''; ?>>Dog</option>
                <option value="Cat" <?php echo ($species=='Cat')?'selected':''; ?>>Cat</option>
                <option value="Bird" <?php echo ($species=='Bird')?'selected':''; ?>>Bird</option>
                <option value="Horse" <?php echo ($species=='Horse')?'selected':''; ?>>Horse</option>
                <option value="Rabbit" <?php echo ($species=='Rabbit')?'selected':''; ?>>Rabbit</option>
                <option value="Reptile" <?php echo ($species=='Reptile')?'selected':''; ?>>Reptile</option>
                <option value="Ferret" <?php echo ($species=='Ferret')?'selected':''; ?>>Ferret</option>
                <option value="Other" <?php echo ($species=='Other')?'selected':''; ?>>Other</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('dateRange'); ?>"><?php _e('Within Past', 'pb_lfdb_widget'); ?></label>
            <select name="<?php echo $this->get_field_name('dateRange'); ?>" id="<?php echo $this->get_field_id('dateRange'); ?>" type="text">
                <option value="0" <?php echo ($dateRange=='0')?'selected':''; ?>>All Time</option>
                <option value="30" <?php echo ($dateRange=='30')?'selected':''; ?>>1 Month</option>
                <option value="90" <?php echo ($dateRange=='90')?'selected':''; ?>>3 Months</option>
                <option value="180" <?php echo ($dateRange=='180')?'selected':''; ?>>6 Months</option>
                <option value="365" <?php echo ($dateRange=='365')?'selected':''; ?>>1 Year</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sort'); ?>"><?php _e('Sort', 'pb_lfdb_widget'); ?></label>
            <select name="<?php echo $this->get_field_name('sort'); ?>" id="<?php echo $this->get_field_id('sort'); ?>" type="text">
                <option value="recency" <?php echo ($sort=='recency')?'selected':''; ?>>Recency</option>
                <option value="distance" <?php echo ($sort=='distance')?'selected':''; ?>>Distance</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('perPage'); ?>"><?php _e('Per Page', 'pb_lfdb_widget'); ?></label>
            <select name="<?php echo $this->get_field_name('perPage'); ?>" id="<?php echo $this->get_field_id('perPage'); ?>" type="text">
                <option value="4" <?php echo ($perPage=='4')?'selected':''; ?>>4</option>
                <option value="8" <?php echo ($perPage=='8')?'selected':''; ?>>8</option>
                <option value="12" <?php echo ($perPage=='12')?'selected':''; ?>>12</option>
                <option value="16" <?php echo ($perPage=='16')?'selected':''; ?>>16</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height', 'pb_lfdb_widget'); ?></label>
            <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('optIn'); ?>"><?php _e('Hide "Powered By PawBoost"', 'pb_lfdb_widget'); ?></label>
            <input id="<?php echo $this->get_field_id('optIn'); ?>" name="<?php echo $this->get_field_name('optIn'); ?>" type="radio" value="1" <?php echo ($optIn=='1')?'checked':''; ?> />Yes
            <input id="<?php echo $this->get_field_id('optIn'); ?>" name="<?php echo $this->get_field_name('optIn'); ?>" type="radio" value="0" <?php echo ($optIn=='0')?'checked':''; ?>/>No
        </p>
        <?php
    }
}

function register_lfdb_widget() {
    register_widget('pb_lfdb_widget');
}
add_action( 'widgets_init', 'register_lfdb_widget' );