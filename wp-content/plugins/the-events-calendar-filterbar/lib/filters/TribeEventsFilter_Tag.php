<?php

/**
 * Class TribeEventsFilter_Tag
 */
class TribeEventsFilter_Tag extends TribeEventsFilter{
	public $type = 'checkbox';

	protected function get_values() {
		$tags_array = array();

		$tags = get_tags();
		foreach( $tags as $tag ) {
			$tags_array[$tag->term_id] = array(
				'name' => $tag->name,
				'value' => $tag->term_id,
			);
		}

		return $tags_array;
	}

	protected function setup_query_args() {
		$this->queryArgs = array( 'tag__in' => $this->currentValue );
	}
}
 