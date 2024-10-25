<?php if (!defined('FW')) {
	die('Forbidden');
} ?>

<?php //get_events_from_portal(); ?>

<?php
$response = wp_remote_get( get_template_directory_uri().'/events.json' );
if ( is_wp_error( $response ) ) return;

$body = wp_remote_retrieve_body( $response );
$events = json_decode( $body, true);
$now = date('Y-m-d H:i:s');
$upcoming_events = [];

foreach ($events["events"] as $event) {
  $new_event = array(
    'event_id' => $event['event_id'],
    'name' => $event['name'],
    'description' => $event['description'],
    'facebook_link' => $event['facebook_link'],
    'img' => $event['img'],
    'nearest_start_date' => find_closest_date($event['items'], $now),
    'dates' => arrangeDates($event['items'])
  );

  $new_event['dates_string'] = dates_to_string($new_event['dates']);
  $upcoming_events[] = $new_event;
}

// sorting by nearest start date
usort($upcoming_events, function($a, $b){
  $a_start = strtotime($a['nearest_start_date']);
  $b_start = strtotime($b['nearest_start_date']);
  return $a_start > $b_start;
});
?>

<?php if( !empty( $upcoming_events ) ) : ?>
<section class="upcoming-events-wrap" style="background-image:url(<?php echo $atts['upcoming_events_bg']['url']; ?>);">
  <div class="fw-container">
    <div class="fw-row">
      <div class="fw-col-sm-12 title-with-line sect-with-line">
        <div class="fw-main-row-overlay"></div>
        <div class="fw-col-inner">
          <div class="fw-heading fw-heading-h3 fw-heading-center">
            <h3 class="fw-special-title"><?php echo $atts['upcoming_events_title']; ?></h3>
            <div class="fw-special-subtitle"><?php echo $atts['upcoming_events_subtitle']; ?></div>
          </div>

          <div class="upcoming-events">
            <?php
            $key = 1;
            foreach( $upcoming_events as $event ) : ?>
            <?php if($key === 5) break; ?>
            <?php if($key === 1) : ?>
            <div class="upcoming-events__item">
              <div class="upcoming-events__title">Featured</div>
              <a href="<?php echo $event['facebook_link']; ?>" class="event-card --large" target="_blank">
                <span class="event-card__img">
                  <img src="<?php echo $event['img']; ?>" alt="">
                </span>
                <span class="event-card__content">
                  <span class="event-card__title"><?php echo $event['name']; ?></span>
                  <span class="event-card__desc"><?php echo $event['description']; ?></span>
                  <span class="event-card__date"><?php echo $event['dates_string']; ?></span>
                </span>
              </a>
            </div>

            <div class="upcoming-events__item">
              <div class="upcoming-events__title">Upcoming Events</div>
              <?php else : ?>
                <a href="<?php echo $event['facebook_link']; ?>" class="event-card" target="_blank">
                  <span class="event-card__img">
                    <img src="<?php echo $event['img']; ?>" alt="">
                  </span>
                  <span class="event-card__content">
                    <span class="event-card__title"><?php echo $event['name']; ?></span>
                    <span class="event-card__desc"><?php echo $event['description']; ?></span>
                    <span class="event-card__date"><?php echo $event['dates_string']; ?></span>
                  </span>
                </a>
              <?php endif; ?>
              <?php $key++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php  endif; ?>
