<?php
class encadTemplateOptions
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Theme Options', 
            'manage_options', 
            'options-page', 
            array( $this, 'create_encad_template_options_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_encad_template_options_page() {
        // Set class property
        $this->options = get_option( 'encad_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?><h2>Theme Options for <?php bloginfo('name'); ?></h2>   
			<h3><small>by Bernd Fecht, encad consulting GmbH</small></h3>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'encad_option_group' );   
                do_settings_sections( 'options-page' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {        
        register_setting(
            'encad_option_group', // Option group
            'encad_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'header_section', // ID
            'Header', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        );  
		
		add_settings_field(
			'header_color', // ID
			'Background Color', // Title
			array( $this, 'create_header_color_field'), // Callback
			'options-page', // Page
			'header_section' // Section
		);
		
		add_settings_field(
			'header_background_image_url',
			'Background Image',
			array( $this, 'create_header_background_media_browser_field'),
			'options-page',
			'header_section'
		);
		
		add_settings_field(
			'header_logo_image_url',
			'Company Logo',
			array( $this, 'create_header_logo_media_browser_field'),
			'options-page',
			'header_section'
		);
    }
	
	 /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
		
		if( isset( $input['header_color'] ) )
            $new_input['header_color'] = sanitize_text_field( $input['header_color'] );
		
		if( isset( $input['header_background_image_url'] ) )
            $new_input['header_background_image_url'] = sanitize_text_field( $input['header_background_image_url'] );
		
		if( isset( $input['header_logo_image_url'] ) )
            $new_input['header_logo_image_url'] = sanitize_text_field( $input['header_logo_image_url'] );

        return $new_input;
    }


    /** 
     * Print the Section text
     */
    public function print_section_info() {
        print 'Enter your settings below:';
    }
	
	/** 
     * Create a color-picker field
     */
	public function create_header_color_field() {
		printf(
			'<input type="text" id="header_color" class="color-picker" name="encad_options[header_color]" value="%s" style="background:%s" />',
			isset( $this->options['header_color'] ) ? esc_attr( $this->options['header_color']) : '#ffffff',
			isset( $this->options['header_color'] ) ? esc_attr( $this->options['header_color']) : '#ffffff'
		);
	}
	
	public function create_header_background_media_browser_field() {
		printf(
			'<input type="text" id="header_background_image_url" name="encad_options[header_background_image_url]" value="%s"/>
			<a href="#" id="header_background_image" class="button image_picker">Select Image</a>',
			isset( $this->options['header_background_image_url'] ) ? esc_attr( $this->options['header_background_image_url']) : ''
		);
	}
	
	public function create_header_logo_media_browser_field() {
		printf(
			'<input type="text" id="header_logo_image_url" name="encad_options[header_logo_image_url]" value="%s"/>
			<a href="#" id="header_logo_image" class="button image_picker">Select Image</a>',
			isset( $this->options['header_logo_image_url'] ) ? esc_attr( $this->options['header_logo_image_url']) : ''
		);
	}
}

if( is_admin() )
    $template_settings = new encadTemplateOptions();