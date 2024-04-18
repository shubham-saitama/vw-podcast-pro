<?php
$section_hide = get_theme_mod('vw_podcast_pro_history_sec_image_enable');

if('Disable' == $section_hide){
    return;
}

?>
<section>
    <div class="event-add-section section-space">
        <div class="container-fluid p-0">
            <div class="row p-0">
                <div class="playlist col-lg-6 col-md-12 col-12">

                    <?php
                    // Get the track history
                    $track_history = get_track_history();
                    $i = 1;
                    // Check if there is any track history
                    if (!empty($track_history)) {
                        echo '<ul>';
                        foreach ($track_history as $track_id) {

                            $track_url = wp_get_attachment_url($track_id);

                            global $wpdb;
                            $sql_query = $wpdb->prepare(
                                "SELECT post_id 
                                FROM {$wpdb->prefix}postmeta
                                WHERE meta_key = 'song_mp3_file'
                                AND meta_value = %s
                                LIMIT 6",
                                $track_url
                            );
                            $post_ids = $wpdb->get_col($sql_query);

                            if ($post_ids) {
                                foreach ($post_ids as $post_id) {
                                    if ($i > 6) {
                                        break; // Stop processing tracks if already rendered 6
                                    }

                                    $track_url_1 = wp_get_attachment_url($track['post_id']);
                                    $post_title = get_the_title($post_id);
                                    $content = get_post_field('post_content', $post_id);
                                    $thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
                                    $single_page_url = get_permalink($post_id);
                                    $radio_terms = wp_get_post_terms($post_id, 'radios');
                                    $first_term = !empty($radio_terms) ? get_term_link($radio_terms[0]) : ''; // Extracting the first term link if present
                                    $artist_terms = wp_get_post_terms($post_id, 'artists');
                                    $artist_link = !empty($artist_terms) ? get_term_link($artist_terms[0]) : ''; // Extracting the artist term link if present
                                    ?>
                                    <div class="player-history">
                                        <div class="song-thumbnail" style="background-image:url()">
                                            <?php if ($track_url_1) {
                                                echo do_shortcode("[vwwaveplayer url='" . $track_url_1 . "' size='sm' skin='thumb_n_wave' override_wave_colors='0' style='light' autoplay='0']");

                                            } ?>
                                        </div>
                                        <div class="song-info-wrap">
                                            <div class="song-his-thumb">
                                                <?php if ($thumbnail_new) { ?>
                                                    <img src="<?php echo $thumbnail_new; ?>" alt="History Thumbnail">
                                                <?php } ?>
                                            </div>
                                            <div class="song-title-des-wrap">
                                                <div class="song-title">
                                                    <a href="<?php echo $single_page_url; ?>">
                                                        <?php echo $post_title; ?>
                                                    </a>
                                                </div>
                                                <div class="song-description">
                                                    <p>
                                                        <?php echo $content; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="option-trigger"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                            <div class="options">
                                                <ul class="option-wrapper">
                                                    <li class="options-div"><a href="<?php the_permalink($post_id); ?>">View Song</a>
                                                    </li>
                                                    <?php echo !empty($artist_link) ? '<li class="options-div"><a href="' . esc_url($artist_link) . '">View Artist</a></li>' : ''; ?>
                                                    <?php echo !empty($first_term) ? '<li class="options-div"><a href="' . esc_url($first_term) . '">Song Radio</a></li>' : ''; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    // Increment $i only if a track is rendered and the conditions are met
                                    $i++;
                                }
                            }

                        }
                        echo '</ul>';
                    } else {
                        // If there is no track history, display a message
                        echo '<p>No track history available.</p>';
                    }

                    ?>

                </div>
                <?php
                // Query Ad Event posts
                $args = array(
                    'post_type' => 'ad_event', // Custom post type name
                    'posts_per_page' => -1, // Retrieve all posts
                );

                $ad_event_query = new WP_Query($args);

                // Check if there are any posts
                if ($ad_event_query->have_posts()):
                    // Start the loop
                    while ($ad_event_query->have_posts()):
                        $ad_event_query->the_post();
                        // Get post title
                        $post_title = get_the_title();

                        // Get meta fields
                        $artists = get_post_meta(get_the_ID(), 'artists', true);
                        $date = get_post_meta(get_the_ID(), 'date', true);
                        $venue_name = get_post_meta(get_the_ID(), 'venue_name', true);
                        $start_time = get_post_meta(get_the_ID(), 'start_time', true);
                        $end_time = get_post_meta(get_the_ID(), 'end_time', true);
                        $entry_fee_tag = get_post_meta(get_the_ID(), 'entry_fee_tag', true);
                        $date = get_post_meta(get_the_ID(), 'date', true);
                        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        // Convert MySQL date format to a formatted date string
                        $date = get_post_meta(get_the_ID(), 'date', true);
                        $song_link = get_post_meta(get_the_ID(), 'song_mp3_file', true);
                        // Convert MySQL date format to a formatted date string
                        $formatted_date = mysql2date(get_option('date_format'), $date);

                        // Format the date string according to the site's settings
                        $date_parts = date_i18n('j M Y', strtotime($formatted_date)); // Day Month Year
                
                        // Extract day, month, and year from the formatted date string
                        list($day, $month, $year) = explode(' ', $date_parts);

                        // Output post content and meta data
                        ?>

                        <div class="ad-event col-lg-6 col-md-12 col-12"
                            style="background-image: url(<?php echo $featured_image_url ?>);">
                            <h5>
                                <?php echo $post_title ?>
                            </h5>
                            <div class="artist">
                                <?php echo esc_html($artists); ?>
                            </div>
                            <div class="date-venue-wrap">
                                <div class="date">
                                    <?php echo $day ?>
                                    <small>
                                        <?php echo $month; ?>
                                        <?php echo $year; ?>
                                    </small>
                                </div>
                                <div class="venue-wrap">
                                    <div class="venue-name">
                                        <?php echo $venue_name ?>
                                    </div>
                                    <div class="evt-timing" data-start="<?php echo $start_time; ?>"
                                        data-end="<?php echo $end_time; ?> ">
                                        <?php echo $start_time . ' - ' . $end_time ?>
                                    </div>
                                </div>
                            </div>
                            <div class="count-wrapper">
                                <div id="countdown-timer">

                                </div>
                                <div class="entry-fee"><strong>Entry :</strong>
                                    <?php echo esc_html($entry_fee_tag); ?>
                                </div>
                            </div>
                            <div class="player_mini">
                                <?php
                                echo do_shortcode("[vwwaveplayer url='" . $song_link . "' size = 'sm' skin='thumb_n_wave' override_wave_colors='0' style='light' autoplay='0']");
                                ?>
                            </div>
                            <div class="live">
                                live
                            </div>
                            <div id="ad-event-start-time">
                                <?php echo $start_time; ?>
                            </div>
                            <p id="ad-event-date">
                                <?php echo esc_html($date); ?>
                            </p>
                        </div>

                        <?php
                    endwhile;
                    // Reset Post Data
                    wp_reset_postdata();
                else:
                    // If no posts found
                    echo 'No ad events found.';
                endif;
                ?>
            </div>
        </div>
    </div>
</section>


<script>
jQuery(document).ready(function ($) {
    // Function to update countdown timer or display "Expired"
    function updateCountdownTimer() {
        // Get event date and time from div elements
        var eventDateText = $('#ad-event-date').text().trim(); // Assuming the date is stored in a div with id "ad-event-date"
        var eventTimeText = $('#ad-event-start-time').text().trim(); // Assuming the start time is stored in a div with id "ad-event-start-time"

        // Parse event date and time into JavaScript Date object
        var eventDateTime = new Date(eventDateText + ' ' + eventTimeText);

        // Get current date and time
        var currentDate = new Date();

        // Check if event date has already passed
        if (eventDateTime <= currentDate) {
            // Event has expired
            $('#countdown-timer').text('Expired');
            return; // Exit the function to prevent further execution
        }

        // Calculate remaining time to event start time
        var timeDiff = eventDateTime - currentDate;

        // Convert remaining time to days, hours, minutes, and seconds
        var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

        // Display countdown timer
        $('#countdown-timer').html(
            '<span class="countdown-days">' + days + '</span> :' +
            '<span class="countdown-hours">' + hours + '</span> :' +
            '<span class="countdown-minutes">' + minutes + '</span> :' +
            '<span class="countdown-seconds">' + seconds + '</span>'
        );
    }

    // Update countdown timer initially
    updateCountdownTimer();

    // Update countdown timer every second
    setInterval(updateCountdownTimer, 1000);

});


    // Function to format time from 24-hour to 12-hour format
    function formatTime(time24) {
        var timeParts = time24.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);

        var meridiem = (hours < 12) ? 'AM' : 'PM';
        hours = (hours % 12) || 12;
        hours = (hours < 10) ? '0' + hours : hours;
        minutes = (minutes < 10) ? '0' + minutes : minutes;

        return hours + ':' + minutes + ' ' + meridiem;
    }

    // Get all elements with class 'evt-timing'
    var timingDivs = document.querySelectorAll('.evt-timing');

    // Loop through each div and update its content
    timingDivs.forEach(function (div) {
        var startTime = div.getAttribute('data-start');
        var endTime = div.getAttribute('data-end');

        div.innerHTML = formatTime(startTime) + ' - ' + formatTime(endTime);
    });

</script>