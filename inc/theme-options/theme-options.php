<?php
/**
 * NeN Theme Options
 *
 * @package NeN
 * @since NeN 1.0
 */

/**
 * Register the form setting for our nen_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, nen_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since NeN 1.0
 */
function nen_theme_options_init() {
	register_setting(
		'nen_options', // Options group, see settings_fields() call in nen_theme_options_render_page()
		'nen_theme_options', // Database option, see nen_get_theme_options()
		'nen_theme_options_validate' // The sanitization callback, see nen_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see nen_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'sample_checkbox', // Unique identifier for the field for this section
		__( 'Sample Checkbox', 'nen' ), // Setting field label
		'nen_settings_field_sample_checkbox', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see nen_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'sample_text_input', __( 'Sample Text Input', 'nen' ), 'nen_settings_field_sample_text_input', 'theme_options', 'general' );
	add_settings_field( 'sample_select_options', __( 'Sample Select Options', 'nen' ), 'nen_settings_field_sample_select_options', 'theme_options', 'general' );
	add_settings_field( 'sample_radio_buttons', __( 'Sample Radio Buttons', 'nen' ), 'nen_settings_field_sample_radio_buttons', 'theme_options', 'general' );
	add_settings_field( 'sample_textarea', __( 'Sample Textarea', 'nen' ), 'nen_settings_field_sample_textarea', 'theme_options', 'general' );
}
add_action( 'admin_init', 'nen_theme_options_init' );

/**
 * Change the capability required to save the 'nen_options' options group.
 *
 * @see nen_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see nen_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function nen_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_nen_options', 'nen_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since NeN 1.0
 */
function nen_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'nen' ),   // Name of page
		__( 'Theme Options', 'nen' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'nen_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'nen_theme_options_add_page' );

/**
 * Returns an array of sample select options registered for NeN.
 *
 * @since NeN 1.0
 */
function nen_sample_select_options() {
	$sample_select_options = array(
		'0' => array(
			'value' =>	'0',
			'label' => __( 'Zero', 'nen' )
		),
		'1' => array(
			'value' =>	'1',
			'label' => __( 'One', 'nen' )
		),
		'2' => array(
			'value' => '2',
			'label' => __( 'Two', 'nen' )
		),
		'3' => array(
			'value' => '3',
			'label' => __( 'Three', 'nen' )
		),
		'4' => array(
			'value' => '4',
			'label' => __( 'Four', 'nen' )
		),
		'5' => array(
			'value' => '5',
			'label' => __( 'Five', 'nen' )
		)
	);

	return apply_filters( 'nen_sample_select_options', $sample_select_options );
}

/**
 * Returns an array of sample radio options registered for NeN.
 *
 * @since NeN 1.0
 */
function nen_sample_radio_buttons() {
	$sample_radio_buttons = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'nen' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'nen' )
		),
		'maybe' => array(
			'value' => 'maybe',
			'label' => __( 'Maybe', 'nen' )
		)
	);

	return apply_filters( 'nen_sample_radio_buttons', $sample_radio_buttons );
}

/**
 * Returns the options array for NeN.
 *
 * @since NeN 1.0
 */
function nen_get_theme_options() {
	$saved = (array) get_option( 'nen_theme_options' );
	$defaults = array(
		'sample_checkbox'       => 'off',
		'sample_text_input'     => '',
		'sample_select_options' => '',
		'sample_radio_buttons'  => '',
		'sample_textarea'       => '',
	);

	$defaults = apply_filters( 'nen_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the sample checkbox setting field.
 */
function nen_settings_field_sample_checkbox() {
	$options = nen_get_theme_options();
	?>
	<label for="sample-checkbox">
		<input type="checkbox" name="nen_theme_options[sample_checkbox]" id="sample-checkbox" <?php checked( 'on', $options['sample_checkbox'] ); ?> />
		<?php _e( 'A sample checkbox.', 'nen' ); ?>
	</label>
	<?php
}

/**
 * Renders the sample text input setting field.
 */
function nen_settings_field_sample_text_input() {
	$options = nen_get_theme_options();
	?>
	<input type="text" name="nen_theme_options[sample_text_input]" id="sample-text-input" value="<?php echo esc_attr( $options['sample_text_input'] ); ?>" />
	<label class="description" for="sample-text-input"><?php _e( 'Sample text input', 'nen' ); ?></label>
	<?php
}

/**
 * Renders the sample select options setting field.
 */
function nen_settings_field_sample_select_options() {
	$options = nen_get_theme_options();
	?>
	<select name="nen_theme_options[sample_select_options]" id="sample-select-options">
		<?php
			$selected = $options['sample_select_options'];
			$p = '';
			$r = '';

			foreach ( nen_sample_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="sample_theme_options[selectinput]"><?php _e( 'Sample select input', 'nen' ); ?></label>
	<?php
}

/**
 * Renders the radio options setting field.
 *
 * @since NeN 1.0
 */
function nen_settings_field_sample_radio_buttons() {
	$options = nen_get_theme_options();

	foreach ( nen_sample_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="nen_theme_options[sample_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sample_radio_buttons'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

/**
 * Renders the sample textarea setting field.
 */
function nen_settings_field_sample_textarea() {
	$options = nen_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="nen_theme_options[sample_textarea]" id="sample-textarea" cols="50" rows="10" /><?php echo esc_textarea( $options['sample_textarea'] ); ?></textarea>
	<label class="description" for="sample-textarea"><?php _e( 'Sample textarea', 'nen' ); ?></label>
	<?php
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since NeN 1.0
 */
function nen_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'nen' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'nen_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see nen_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since NeN 1.0
 */
function nen_theme_options_validate( $input ) {
	$output = array();

	// Checkboxes will only be present if checked.
	if ( isset( $input['sample_checkbox'] ) )
		$output['sample_checkbox'] = 'on';

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['sample_text_input'] ) && ! empty( $input['sample_text_input'] ) )
		$output['sample_text_input'] = wp_filter_nohtml_kses( $input['sample_text_input'] );

	// The sample select option must actually be in the array of select options
	if ( isset( $input['sample_select_options'] ) && array_key_exists( $input['sample_select_options'], nen_sample_select_options() ) )
		$output['sample_select_options'] = $input['sample_select_options'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sample_radio_buttons'] ) && array_key_exists( $input['sample_radio_buttons'], nen_sample_radio_buttons() ) )
		$output['sample_radio_buttons'] = $input['sample_radio_buttons'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['sample_textarea'] ) && ! empty( $input['sample_textarea'] ) )
		$output['sample_textarea'] = wp_filter_post_kses( $input['sample_textarea'] );

	return apply_filters( 'nen_theme_options_validate', $output, $input );
}
