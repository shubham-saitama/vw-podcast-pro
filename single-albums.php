<?php
/**
 * Template Name: Single album Page
 */
get_header();
$background_img = get_theme_mod('vw_podcast_pro_inner_page_banner_bgimage');
?>
<div class="body-wrapper">

<nav class="main-sidebar">
    <span class="mobile-open">
      <i class="fas fa-chevron-left d-none"></i>
      <i class="fas fa-chevron-right"></i>
    </span>
    <div class="inner-slidbar">
      <?php dynamic_sidebar('main-sidebar'); ?>
    </div>
  </nav>
  <div class="main-pageWrap">
    <?php get_template_part('template-parts/home/section-header'); ?>
    <div class="title-box text-center banner-img my-5"
      style="background-image:url(<?php echo esc_url($background_img); ?>)">
      <div class="banner-page-text ">
        <div class="row">
          <div class="col-lg-4 col-sm-6 col-6">
            <div class="above_title">
              <h1>
                <?php the_title(); ?>
              </h1>
              <?php if (get_theme_mod('vw_podcast_pro_site_breadcrumb_enable', true) != '') { ?>
                <div class=" bradcrumbs">
                  <?php vw_podcast_pro_the_breadcrumb(); ?>
                </div>
              <?php }
              ?>
            </div>
          </div>
          <div class="col-lg-8">

          </div>
        </div>
      </div>
    </div>
    <?php do_action('vw_podcast_pro_after_defaulttitle'); ?>

    <div class="post-section">
      <div class="">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12">
            <?php while (have_posts()):
              the_post();
              if (has_post_thumbnail()) { // Check if the post has a featured image
                the_post_thumbnail(); // Display the featured image
              }
            endwhile; ?>
          </div>
          <div class="col-lg-8 col-md-6 col-12 single-right-wrapper">
            <div class="song-info-bar">
              <h2>
                <?php the_title(); ?>
              </h2>
              <div class="artist-cat">
                <?php while (have_posts()):
                  the_post();



                  $author_name = get_the_author_meta('display_name');

                  // Get the post author's avatar URL
                  $author_avatar_url = get_avatar_url($author_id, array('size' => 100)); // Adjust the size as needed
                


                  echo '<div class="artist-img"><img src="' . $author_avatar_url . '" alt="Artist image" title="Song Artist"></div>';
                  echo '<div class="artist-name">' . $author_name . '</div>'; // Output the term name
                
                  $selected_songs = get_post_meta($post->ID, 'selected_songs', true);
                  // Extract the first song from the selected songs array
                  $first_song_id = !empty($selected_songs) ? $selected_songs[0] : null;

                  $attachment_url = get_post_meta($first_song_id, 'song_mp3_file', 'true');

                  // Get attachment ID from URL
                  $attachment_id = attachment_url_to_postid($attachment_url);

                  // Check if attachment ID exists
                
                  // Get attachment metadata
                  $attachment_metadata = wp_get_attachment_metadata($attachment_id);
                  // Retrieve existing values for collection name, artist name, movie name, company name, play count, and duration
                  $collection_name = get_post_meta($post->ID, 'collection_name', true);
                  $artist_name = get_post_meta($post->ID, 'artist_name', true);
                  $movie_name = get_post_meta($post->ID, 'movie_name', true);

                  $company_name = get_post_meta($post->ID, 'company_name', true);
                  $play_count = get_post_meta($post->ID, 'play_count', true);
                  $duration = get_post_meta($post->ID, 'duration', true);
                  $likes_count = 0;


                  $collection_name = !empty($collection_name) ? $collection_name : 'N/A';
                  $artist_name = !empty($artist_name) ? $artist_name : 'N/A';
                  $movie_name = !empty($movie_name) ? $movie_name : 'N/A';
                  $company_name = !empty($company_name) ? $company_name : 'N/A';
                  $play_count = !empty($play_count) ? $play_count : 'N/A';
                  $duration = !empty($duration) ? $duration : 'N/A';

                  echo "<div class='played'> " . $play_count . " played - " . $duration . " Min</div>";

                  // echo "<div class='likes-count'><i class='fa fa-heart' aria-hidden='true'></i>" . $likes_count . "</div>";

                  echo '<div class="album-metadata">';
                  echo "$collection_name | $artist_name | $album | $company_name";
                  echo '</div>';


                  ?>

                </div>
              </div>
              <div class="row playlist-player">
                <?php echo do_shortcode("[vwwaveplayer url=" . $attachment_url . " shape = 'square' size='xs' skin='w3-exhibition' override_wave_colors='0' style='light' autoplay='0']");
                endwhile; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="playheading">
      <div class="list-item-title">Track</div>
      <div class="list-item-title">Artist</div>
      <div class="list-item-title">Duretion</div>
    </section>
    <section class="playlist-holder">

      <?php
      // Get the current album post
      global $post;
      $i = 1;
      // Get selected songs array
      $selected_songs = get_post_meta($post->ID, 'selected_songs', true);
      if (!empty($selected_songs)) {
        foreach ($selected_songs as $song_id) {
          $song_url = get_post_meta($song_id, 'song_mp3_file', 'true');
          $song_title = get_the_title($song_id);
          $song_permalink = get_permalink($song_id);
          $artist_terms = wp_get_post_terms($song_id, 'artists');
          $artist_link = !empty($artist_terms) ? get_term_link($artist_terms[0]) : ''; // Extracting the artist term link if present
          $radio_terms = wp_get_post_terms($song_id, 'radios');
          $first_term = !empty($radio_terms) ? get_term_link($radio_terms[0]) : ''; // Extracting the first term link if present
          $meta_value = attachment_url_to_postid($song_url);
          $attachment_metadata = wp_get_attachment_metadata($meta_value);
          $length_formatted = isset($attachment_metadata['length_formatted']) ? $attachment_metadata['length_formatted'] : 'N/A';
          $artist = isset($attachment_metadata["artist"]) ? $attachment_metadata['artist'] : 'Artist N/A';
          ?>

          <div class="player-history album">
            <div class="song-info-wrap">
              <div class="liked-div-wrapper">
                <?php echo do_shortcode("[vwwaveplayer url=" . $song_url . " shape = 'square' size='xs' skin='w3-exhibition' override_wave_colors='0' style='light' autoplay='0']"); ?>
                <div class="duretion">
                  <?php echo $length_formatted; ?>
                </div>
              </div>
              <div class="song-albun-history">
                <?php echo $artist; ?>
              </div>
              <div class="song-title-des-wrap">
                <div class="song-title">
                  <a href="<?php echo $song_permalink; ?>">
                    <?php echo $song_title; ?>
                  </a>
                </div>
              </div>
              <div class="option-trigger"><i class="fa-solid fa-ellipsis-vertical"></i></div>
              <div class="options">
                <ul class="option-wrapper">
                  <li class="options-div"><a href="<?php the_permalink($song_id); ?>">View Song</a>
                  </li>
                  <?php echo !empty($artist_link) ? '<li class="options-div"><a href="' . esc_url($artist_link) . '">View Artist</a></li>' : ''; ?>
                  <?php echo !empty($first_term) ? '<li class="options-div"><a href="' . esc_url($first_term) . '">Song Radio</a></li>' : ''; ?>
                </ul>
              </div>
              <div class="serial-number">
                <?php echo $i; ?>.
              </div>
            </div>
          </div>
          <?php
          $i++;
        }

        echo '</ul>';
      } else {
        echo '<p>No songs selected for this album.</p>';
      }
      ?>
    </section>


    <?php get_footer(); ?>
  </div>
</div>