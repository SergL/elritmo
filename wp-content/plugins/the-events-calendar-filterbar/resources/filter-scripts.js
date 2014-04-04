(function ($, td, te, tf, ts, tt, dbug) {

	/*
	 * $    = jQuery
	 * td   = tribe_ev.data
	 * te   = tribe_ev.events
	 * tf   = tribe_ev.fn
	 * ts   = tribe_ev.state
	 * tt   = tribe_ev.tests
	 * dbug = tribe_debug
	 */

	$.extend(tribe_ev.fn, {
		set_form: function (params) {

			var has_sliders = false,
				$body = $('body'),
				$form = $('#tribe_events_filters_form'),
				$bar_form = $('#tribe-bar-form');

			$body.addClass('tribe-reset-on');

			if ($form.length) {

				$form.tribe_clear_form();

				if ($form.find('.ui-slider').length) {

					has_sliders = true;

					$('#tribe_events_filters_form .ui-slider').each(function () {
						var s_id = $(this).attr('id');
						var $this = $('#' + s_id);
						var $input = $this.prev();
						var $display = $input.prev();
						var settings = $this.slider("option");

						$this.slider("values", 0, settings.min);
						$this.slider("values", 1, settings.max);
						$display.text(settings.min + " - " + settings.max);
						$input.val('');
					});
				}
			}

			if ($bar_form.length) {
				$bar_form.tribe_clear_form();
			}

			params = tf.parse_string(params);

			$.each(params, function (key, value) {
				if (key !== 'action') {
					var name = decodeURI(key);
					var $target = '';
					if (value.length === 1) {
						if ($('[name="' + name + '"]').is('input[type="text"], input[type="hidden"]')) {
							$('[name="' + name + '"]').val(value);
						} else if ($('[name="' + name + '"][value="' + value + '"]').is(':checkbox, :radio')) {
							$('[name="' + name + '"][value="' + value + '"]').prop("checked", true);
						} else if ($('[name="' + name + '"]').is('select')) {
							$('select[name="' + name + '"] option[value="' + value + '"]').attr('selected', true);
						}
					} else {
						for (var i = 0; i < value.length; i++) {
							$target = $('[name="' + name + '"][value="' + value[i] + '"]');
							if ($target.is(':checkbox, :radio')) {
								$target.prop("checked", true);
							} else {
								$('select[name="' + name + '"] option[value="' + value[i] + '"]').attr('selected', true);
							}
						}
					}
				}
			});

			if (has_sliders) {
				$('#tribe_events_filters_form .ui-slider').each(function () {
					var s_id = $(this).attr('id');
					var $this = $('#' + s_id);
					var $input = $this.prev();
					var range = $input.val().split('-');

					if (range[0] !== '') {
						var $display = $input.prev();

						$this.slider("values", 0, range[0]);
						$this.slider("values", 1, range[1]);
						$display.text(range[0] + " - " + range[1]);
						$this.slider('refresh');
					}
				});
			}

			$body.removeClass('tribe-reset-on');
		}
	});

	$(document).ready(function () {

		$(".tribe_events_filter_item").filter(":last").addClass("tribe_last_child");

		var $form = $('#tribe_events_filters_form'),
				$body = $('body');
				$toggle = $('#tribe_events_filters_toggle');		

		if ($('#tribe_events_filter_item_eventcategory').length && ts.category) {
			ts.filter_cats = true;
		}

		function close_filters() {
				$body
					.addClass('tribe-filters-closed')
					.removeClass('tribe-filters-open');

				if (tribe_storage)
					tribe_storage.setItem('tribe_events_filters_wrapper', 'closed');
		}

		function open_filters() {
				$body
					.removeClass('tribe-filters-closed')
					.removeClass('tribe-ajax-success')
					.addClass('tribe-filters-open');

				if (tribe_storage)
					tribe_storage.setItem('tribe_events_filters_wrapper', 'open');
		}

		function toggle_filters() {
			if ($body.is('.tribe-filters-closed')) {
				open_filters();
			} else {
				close_filters();
			}
		}	
		if (tribe_storage) {

			var fb_state = tribe_storage.getItem('tribe_events_filters_wrapper');
			if (  fb_state == null && $body.is('.tribe-filters-closed') ) {
					fb_state = 'closed';
			}
			if (fb_state && fb_state == 'closed' ) {
				close_filters();
			} else if (fb_state && fb_state == 'open' ) {
				open_filters();
			}

			$('.tribe_events_filter_item').each(function () {

				var $this = $(this);
				var f_id = $this.attr('id');
				var fts_id = tribe_storage.getItem(f_id);

				if (fts_id && fts_id == 'closed')
					$this.addClass('closed');
			});
		}

		$('#tribe_events_filters_wrapper').on('click', '#tribe_events_filters_reset', function (e) {

			e.preventDefault();
			$body.addClass('tribe-reset-on');

			$form.tribe_clear_form();

			if ($form.find('.ui-slider').length) {
				$('#tribe_events_filters_form .ui-slider').each(function () {

					var s_id = $(this).attr('id');
					var $this = $('#' + s_id);
					var $input = $this.prev();
					var $display = $input.prev();
					var settings = $this.slider("option");

					$this.slider("values", 0, settings.min);
					$this.slider("values", 1, settings.max);
					$display.text(settings.min + " - " + settings.max);
					$input.val('');
				});
			}
			if ( $('.tribe-events-filters-horizontal').length ) {
				$('.tribe_events_filter_item').addClass('closed');
			}
			$form.submit();
			$body.removeClass('tribe-reset-on');
		});

		$('#tribe_events_filters_wrapper').on('click', '#tribe_events_filters_toggle', function (e) {
			e.preventDefault();
			toggle_filters();
		});

		$form.on('click', 'h3', function () {

			var $this = $(this),
				$parent = $this.parent(),
				f_id = $parent.attr('id');

			if ( $('.tribe-events-filters-horizontal').length ) {
				$('.tribe_events_filter_item').not($parent).addClass('closed');
			}

			if ($parent.hasClass('closed')) {
				$parent.removeClass('closed');
				if (tribe_storage)
					tribe_storage.setItem(f_id, 'open');
			} else {
				$parent.addClass('closed');
				if (tribe_storage)
					tribe_storage.setItem(f_id, 'closed');
			}
		});

		function mobile_close_filters(){
			var wind = $(window),
					windowsize = wind.width();


			if (windowsize < 767) {
				close_filters();

				$(te).on( 'tribe_ev_ajaxSuccess', function() {
						close_filters();
				});	
			}
			console.log(windowsize);
		}
		mobile_close_filters();

		$(window).resize( function() {
			mobile_close_filters();
		});


		function run_view_specific_changes() {
			if (ts.view === 'past' || ts.view === 'list' || ts.view === 'photo' || ts.view === 'map') {
				ts.paged = 1;
				if (ts.view === 'past' || ts.view === 'list') {
					if (ts.filter_cats)
						td.cur_url = $('#tribe-events-header').attr('data-baseurl');
				}
			} else if (ts.view === 'month') {
				ts.date = $('#tribe-events-header').attr('data-date');
				if (ts.filter_cats)
					td.cur_url = $('#tribe-events-header').attr('data-baseurl');
				else
					td.cur_url = tf.url_path(document.URL);

			} else if (ts.view === 'week' || ts.view === 'day') {
				ts.date = $('#tribe-events-header').attr('data-date');
			}
		}


		$form.on('submit', function (e) {
			if (tribe_events_bar_action !== 'change_view') {
				e.preventDefault();
				ts.popping = false;
				run_view_specific_changes();
				tf.pre_ajax(function () {
					$(te).trigger('tribe_ev_runAjax');
				});
			}
		});

		if (tt.live_ajax() && tt.pushstate) {

			$form.find('input[type="submit"]').remove();

			function run_filtered_ajax() {
				tf.disable_inputs('#tribe_events_filters_form', 'input, select');
				ts.popping = false;
				run_view_specific_changes();
				if (ts.view === 'map') {
					if (tt.pushstate) {
						tf.pre_ajax(function () {
							$(te).trigger('tribe_ev_runAjax');
						});
					} else {
						tf.pre_ajax(function () {
							$(te).trigger('tribe_ev_reloadOldBrowser');
						});
					}
				} else {
					tf.pre_ajax(function () {
						$(te).trigger('tribe_ev_runAjax');
					});
				}
			}

			if ($('#tribe_events_filter_item_eventcategory').length && ts.category) {
				$('#tribe_events_filter_item_eventcategory input, #tribe_events_filter_item_eventcategory select').on("change", function () {
					tf.setup_ajax_timer(function () {
						run_filtered_ajax();
					});
				});
			}

			$form.on("slidechange", ".ui-slider", function () {
				tf.setup_ajax_timer(function () {
					run_filtered_ajax();
				});
			});
			$form.on("change", "input, select", function () {
				if (ts.filter_cats && $(this).parents(".tribe_events_filter_item").attr("id") === "tribe_events_filter_item_eventcategory") return;
				tf.setup_ajax_timer(function () {
					run_filtered_ajax();
				});
			});
		}

		$(te).on("tribe_ev_collectParams", function () {
			var tribe_filter_params = tf.serialize('#tribe_events_filters_form', 'input, select');
			if (tribe_filter_params.length) {
				ts.filters = true;
				ts.params = ts.params + '&' + tribe_filter_params;
				if (ts.view !== 'map') {
					if (ts.url_params.length)
						ts.url_params = ts.url_params + '&' + tribe_filter_params;
					else
						ts.url_params = tribe_filter_params;
				}
			} else {
				ts.filters = false;
			}
		});

		$(te).on("tribe_ev_postCollectBarParams", function () {
			if (ts.filter_cats)
				$('#tribe_events_filter_item_eventcategory option:selected, #tribe_events_filter_item_eventcategory input:checked').remove();

			var cv_filter_params = tf.serialize('#tribe_events_filters_form', 'input, select');

			if (ts.url_params.length && cv_filter_params.length)
				ts.url_params = ts.url_params + '&' + cv_filter_params;
			else if (cv_filter_params.length)
				ts.url_params = cv_filter_params;
		});

		if ($('#tribe_events_filter_item_eventcategory').length && ts.category) {
			$body.addClass('tribe-reset-on');
			$('#tribe_events_filter_item_eventcategory option[data-slug="' + ts.category + '"]').attr('selected', true);
			$('#tribe_events_filter_item_eventcategory input[data-slug="' + ts.category + '"]').attr("checked", "checked");
			$body.removeClass('tribe-reset-on');
		}


		dbug && debug.info('filter-scripts.js successfully loaded');
	});

})(jQuery, tribe_ev.data, tribe_ev.events, tribe_ev.fn, tribe_ev.state, tribe_ev.tests, tribe_debug);
