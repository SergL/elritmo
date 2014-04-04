<?php

/**
 * Class TribeEventsFilter_DayOfWeek
 */
class TribeEventsFilter_DayOfWeek extends TribeEventsFilter {
	public $type = 'checkbox';

	protected function get_values() {
		$day_of_week_array = array(
			'1' => __( 'Sunday', 'tribe-events-filter-view' ),
			'2' => __( 'Monday', 'tribe-events-filter-view' ),
			'3' => __( 'Tuesday', 'tribe-events-filter-view' ),
			'4' => __( 'Wednesday', 'tribe-events-filter-view' ),
			'5' => __( 'Thursday', 'tribe-events-filter-view' ),
			'6' => __( 'Friday', 'tribe-events-filter-view' ),
			'7' => __( 'Saturday', 'tribe-events-filter-view' ),
		);

		$day_of_week_values = array();
		foreach ( $day_of_week_array as $value => $name ) {
			$day_of_week_values[] = array(
				'name' => $name,
				'value' => $value,
			);
		}

		return $day_of_week_values;
	}

	protected function setup_join_clause() {
		add_filter( 'posts_join', array( 'TribeEventsQuery', 'posts_join' ), 10, 2 );
	}

	protected function setup_where_clause() {
		/** @var wpdb $wpdb */
		global $wpdb;
		$clauses = array();
		$values = implode(',', array_map('intval', $this->currentValue));
		// does it start on a selected day
		$clauses[] = "(DAYOFWEEK({$wpdb->postmeta}.meta_value) IN ($values))";
		// is it on at least 7 days (first day is 0)
		$clauses[] = "(DATEDIFF(tribe_event_end_date.meta_value, {$wpdb->postmeta}.meta_value) >=6)";

		// determine if the start of the nearest matching day is between the start and end dates
		$distance_to_day = array();
		foreach ( $this->currentValue as $day_of_week_index ) {
			$day_of_week_index = (int)$day_of_week_index;
			$distance_to_day[] = "MOD( 7 + $day_of_week_index - DAYOFWEEK({$wpdb->postmeta}.meta_value), 7 )";
		}
		if ( count($distance_to_day) > 1 ) {
			$distance_to_next_matching_day = "LEAST(".implode(',', $distance_to_day).")";
		} else {
			$distance_to_next_matching_day = reset($distance_to_day);
		}
		$clauses[] = "(DATE(DATE_ADD({$wpdb->postmeta}.meta_value, INTERVAL $distance_to_next_matching_day DAY)) < tribe_event_end_date.meta_value)";

		$this->whereClause = ' AND ('.implode(' OR ', $clauses).')';
	}
}
 