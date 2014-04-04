<?php

/**
 * Class TribeEventsFilter_Cost
 */
class TribeEventsFilter_Cost extends TribeEventsFilter {
	public $type = 'range';
	private $min_cost = NULL;
	private $max_cost = NULL;

	protected function get_submitted_value() {
		if ( isset( $_REQUEST['tribe_' . $this->slug] ) ) {
			$value = $_REQUEST['tribe_' . $this->slug];
			if ( !is_array($value) ) {
				$value = array($value);
			}
			if ( isset($value['min']) && isset($value['max']) ) {
				return array($value);
			} else {
				foreach ( $value as &$v ) {
					$range = explode('-', $v);
					$v = array('min' => $range[0], 'max' => $range[1]);
				}
				return $value;
			}
		}
		return array();
	}

	public function get_admin_form() {
		$title = $this->get_title_field();
		$type = $this->get_type_field();
		return $title.$type;
	}

	protected function get_type_field() {
		$name = $this->get_admin_field_name('type');
		$field = sprintf( __( 'Type: %s %s', 'tribe-events-filter-view' ),
			sprintf( '<label><input type="radio" name="%s" value="range" %s /> %s</label>',
				$name,
				checked( $this->type, 'range', false ),
				__( 'Range Slider', 'tribe-events-filter-view' )
			),
			sprintf( '<label><input type="radio" name="%s" value="checkbox" %s /> %s</label>',
				$name,
				checked( $this->type, 'checkbox', false ),
				__( 'Checkboxes', 'tribe-events-filter-view' )
			)
		);
		return '<div class="tribe_events_active_filter_type_options">'.$field.'</div>';
	}

	protected function get_values() {
		$this->set_min_and_max();

		if ( $this->type == 'range' ) {
			return array( 'min' => $this->min_cost, 'max' => $this->max_cost );
		}

		$cost_range = array();
		if ( $this->min_cost == 0 ) {
			$cost_range['0-0'] =  __('Free', 'tribe-events-filter-view');
		}
		if ( $this->max_cost == $this->min_cost ) {
			if ( $this->max_cost != 0 ) {
				$cost_range[$this->min_cost . '-' . $this->max_cost] = $this->min_cost . '-' . $this->max_cost;
			}
		} else { // break the range into five equal groups
			$cost_chunks = $this->partition_range(floor($this->min_cost), floor($this->max_cost), (5-count($cost_range)));
			foreach ( $cost_chunks as &$chunk ) {
				$cost_range[$chunk['min'].'-'.$chunk['max']] = $chunk['min'].'-'.$chunk['max'];
			}
		}
		$values = array();
		foreach ( $cost_range as $key => $cost ) {
			$values[] = array(
				'name' => $cost,
				'value' => $key,
			);
		}
		return $values;
	}

	private function partition_range( $min, $max, $count ) {
		$range_size = $max - $min + 1;
		$partition_size = floor( $range_size / $count );
		$partition_remainder = $range_size % $count;
		$partitioned = array();
		$mark = $min;
		for ($i = 0; $i < $count; $i++) {
			$incr = ($i < $partition_remainder) ? $partition_size : $partition_size - 1;
			$partitioned[$i] = array(
				'min' => $mark,
				'max' => $mark + $incr,
			);
			$mark += $incr + 1;
		}
		return $partitioned;
	}

	protected function is_selected( $option ){
		if ( is_string($option) ) {
			$option = explode('-', $option);
			$option = array('min' => $option[0], 'max' => $option[1]);
		}
		return in_array($option, $this->currentValue);
	}

	protected function setup_query_filters() {
		if ( $this->currentValue ) {
			$this->set_min_and_max();
		}
		parent::setup_query_filters();
	}

	protected function setup_join_clause() {
		global $wpdb;
		$this->joinClause = " LEFT JOIN {$wpdb->postmeta} AS cost_filter ON ({$wpdb->posts}.ID = cost_filter.post_id)";
	}

	protected function setup_where_clause() {
		global $wpdb;
		$clauses = array();
		foreach ( $this->currentValue as $value ) {
			if ( $value['min'] == 0 && $value['max'] == 0 ) {
				$clauses[] = "(cost_filter.meta_key = '_EventCost' AND (cost_filter.meta_value = 0 OR cost_filter.meta_value = '' OR cost_filter.meta_value IS NULL) )";
			} else {
				$clauses[] = $wpdb->prepare( "(cost_filter.meta_key = '_EventCost' AND cost_filter.meta_value <> 0 AND cost_filter.meta_value IS NOT NULL AND CAST(cost_filter.meta_value AS SIGNED) BETWEEN %d AND %d) ", $value['min'], $value['max'] );
			}
		}
		$this->whereClause = ' AND ('.implode(' OR ', $clauses).') ';
	}

	private function set_min_and_max() {
		if ( !isset($this->max_cost) || !isset($this->min_cost) ) {
			$this->max_cost = tribe_get_maximum_cost();
			$this->min_cost = tribe_get_minimum_cost();
		}
	}
}
 