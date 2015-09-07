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
		
		// Header

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
			'header_background_color_image_url',
			'Background Image #1 <br>(replaces background color)',
			array( $this, 'create_header_background_color_media_browser_field'),
			'options-page',
			'header_section'
		);
		
		
		add_settings_field(
			'header_background_image_url',
			'Background Image #2 <br>(main image)',
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
		
		add_settings_field(
			'header_wrapped',
			'Wrapped Header',
			array( $this, 'create_wrapped_header_checkbox'),
			'options-page',
			'header_section'
		);
		
		// Main Menu
		
		add_settings_section(
            'menu_section', // ID
            'Menu', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        ); 
		
		add_settings_field(
			'menu_color', // ID
			'Background Color', // Title
			array( $this, 'create_menu_color_field'), // Callback
			'options-page', // Page
			'menu_section' // Section
		);
		
		add_settings_field(
			'menu_border_color', // ID
			'Border Color', // Title
			array( $this, 'create_menu_border_color_field'), // Callback
			'options-page', // Page
			'menu_section' // Section
		);
		
		add_settings_field(
			'menu_selected_item_color', // ID
			'Selected Item Color', // Title
			array( $this, 'create_menu_selected_item_color_field'), // Callback
			'options-page', // Page
			'menu_section' // Section
		);
		
		add_settings_field(
			'menu_font_color', // ID
			'Font Color', // Title
			array( $this, 'create_menu_font_color_field'), // Callback
			'options-page', // Page
			'menu_section' // Section
		);
		
		add_settings_field(
			'menu_font_active_color', // ID
			'Font Active Color', // Title
			array( $this, 'create_menu_font_active_color_field'), // Callback
			'options-page', // Page
			'menu_section' // Section
		);
		
		add_settings_field(
			'menu_font_hover_color', // ID
			'Font Hover Color', // Title
			array( $this, 'create_menu_font_hover_color_field'), // Callback
			'options-page', // Page
			'menu_section' // Section
		);
		
		add_settings_field(
			'menu_height',
			'Menu Height',
			array($this, 'create_menu_height_field'),
			'options-page',
			'menu_section'		
		);
		
		// Dropdown Menu
		
		add_settings_section(
            'dropdown_menu_section', // ID
            'Dropdown Menu', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        ); 
		
		add_settings_field(
			'dropdown_menu_color', // ID
			'Background Color', // Title
			array( $this, 'create_dropdown_menu_color_field'), // Callback
			'options-page', // Page
			'dropdown_menu_section' // Section
		);
		
		add_settings_field(
			'dropdown_menu_selected_item_color', // ID
			'Selected Item Color', // Title
			array( $this, 'create_dropdown_menu_selected_item_color_field'), // Callback
			'options-page', // Page
			'dropdown_menu_section' // Section
		);
		
		add_settings_field(
			'dropdown_menu_hover_item_color', // ID
			'Item Hover Color', // Title
			array( $this, 'create_dropdown_menu_hover_item_color_field'), // Callback
			'options-page', // Page
			'dropdown_menu_section' // Section
		);
		
		add_settings_field(
			'dropdown_menu_font_color', // ID
			'Font Color', // Title
			array( $this, 'create_dropdown_menu_font_color_field'), // Callback
			'options-page', // Page
			'dropdown_menu_section' // Section
		);
		
		add_settings_field(
			'dropdown_menu_font_active_color', // ID
			'Font Active Color', // Title
			array( $this, 'create_dropdown_menu_font_active_color_field'), // Callback
			'options-page', // Page
			'dropdown_menu_section' // Section
		);
		
		add_settings_field(
			'dropdown_menu_font_hover_color', // ID
			'Font Hover Color', // Title
			array( $this, 'create_dropdown_menu_font_hover_color_field'), // Callback
			'options-page', // Page
			'dropdown_menu_section' // Section
		);
		
		// Main Page
		
		add_settings_section(
            'main_page_section', // ID
            'Main Page', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        ); 

		add_settings_field(
			'wrapped',
			'Wrapped Website',
			array( $this, 'create_wrapped_website_checkbox'),
			'options-page',
			'main_page_section'
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
		
		// Header
		
		if( isset( $input['header_color'] ) )
            $new_input['header_color'] = sanitize_text_field( $input['header_color'] );
		
		if( isset( $input['header_background_color_image_url'] ) )
            $new_input['header_background_color_image_url'] = sanitize_text_field( $input['header_background_color_image_url'] );
		
		if( isset( $input['header_background_image_url'] ) )
            $new_input['header_background_image_url'] = sanitize_text_field( $input['header_background_image_url'] );
		
		if( isset( $input['header_logo_image_url'] ) )
            $new_input['header_logo_image_url'] = sanitize_text_field( $input['header_logo_image_url'] );

		if( isset( $input['header_wrapped'] ) )
            $new_input['header_wrapped'] = sanitize_text_field( $input['header_wrapped'] );
		
		// Menu
		
		if( isset( $input['menu_color'] ) )
            $new_input['menu_color'] = sanitize_text_field( $input['menu_color'] );
		
		if( isset( $input['menu_border_color'] ) )
            $new_input['menu_border_color'] = sanitize_text_field( $input['menu_border_color'] );
		
		if( isset( $input['menu_selected_item_color'] ) )
            $new_input['menu_selected_item_color'] = sanitize_text_field( $input['menu_selected_item_color'] );
		
		if( isset( $input['menu_font_color'] ) )
            $new_input['menu_font_color'] = sanitize_text_field( $input['menu_font_color'] );
		
		if( isset( $input['menu_font_active_color'] ) )
            $new_input['menu_font_active_color'] = sanitize_text_field( $input['menu_font_active_color'] );
		
		if( isset( $input['menu_font_hover_color'] ) )
            $new_input['menu_font_hover_color'] = sanitize_text_field( $input['menu_font_hover_color'] );
		
		if( isset( $input['menu_height'] ) )
            $new_input['menu_height'] = sanitize_text_field( $input['menu_height'] );
		
		// Dopdown-Menu
		
		if( isset( $input['dropdown_menu_color'] ) )
            $new_input['dropdown_menu_color'] = sanitize_text_field( $input['dropdown_menu_color'] );
		
		if( isset( $input['dropdown_menu_selected_item_color'] ) )
            $new_input['dropdown_menu_selected_item_color'] = sanitize_text_field( $input['dropdown_menu_selected_item_color'] );
		
		if( isset( $input['dropdown_menu_hover_item_color'] ) )
            $new_input['dropdown_menu_hover_item_color'] = sanitize_text_field( $input['dropdown_menu_hover_item_color'] );
		
		if( isset( $input['dropdown_menu_font_color'] ) )
            $new_input['dropdown_menu_font_color'] = sanitize_text_field( $input['dropdown_menu_font_color'] );
		
		if( isset( $input['dropdown_menu_font_active_color'] ) )
            $new_input['dropdown_menu_font_active_color'] = sanitize_text_field( $input['dropdown_menu_font_active_color'] );		
		
		if( isset( $input['dropdown_menu_font_hover_color'] ) )
            $new_input['dropdown_menu_font_hover_color'] = sanitize_text_field( $input['dropdown_menu_font_hover_color'] );		
		
		// Main Page
		
		if( isset( $input['wrapped'] ) )
            $new_input['wrapped'] = sanitize_text_field( $input['wrapped'] );
		
        return $new_input;
    }


    /** 
     * Print the Section text
     */
    public function print_section_info() {
        print 'Enter your settings below:';
    }
	
	/**
	* Header
	*/
	
	public function create_header_color_field() {
		printf(
			'<input type="text" id="header_color" class="color-picker" name="encad_options[header_color]" value="%s" style="background:%s" />',
			isset( $this->options['header_color'] ) ? esc_attr( $this->options['header_color']) : '#ffffff',
			isset( $this->options['header_color'] ) ? esc_attr( $this->options['header_color']) : '#ffffff'
		);
	}
	
	public function create_header_background_color_media_browser_field() {
		printf(		
			'<div><img src="%s" style="max-width: 200px"/></div>
			<input type="text" id="header_background_color_image_url" name="encad_options[header_background_color_image_url]" value="%s"/>
			<a href="#" id="header_background_color_image" class="button image_picker">Select Image</a>',
			isset( $this->options['header_background_color_image_url'] ) ? esc_attr( $this->options['header_background_color_image_url']) : '',
			isset( $this->options['header_background_color_image_url'] ) ? esc_attr( $this->options['header_background_color_image_url']) : ''
		);
	}
	
	public function create_header_background_media_browser_field() {
		printf(		
			'<div><img src="%s" style="max-width: 200px"/></div>
			<input type="text" id="header_background_image_url" name="encad_options[header_background_image_url]" value="%s"/>
			<a href="#" id="header_background_image" class="button image_picker">Select Image</a>',
			isset( $this->options['header_background_image_url'] ) ? esc_attr( $this->options['header_background_image_url']) : '',
			isset( $this->options['header_background_image_url'] ) ? esc_attr( $this->options['header_background_image_url']) : ''
		);
	}
	
	public function create_header_logo_media_browser_field() {
		printf(
			'<div><img src="%s" style="max-width: 200px"/></div>
			<input type="text" id="header_logo_image_url" name="encad_options[header_logo_image_url]" value="%s"/>
			<a href="#" id="header_logo_image" class="button image_picker">Select Image</a>',
			isset( $this->options['header_logo_image_url'] ) ? esc_attr( $this->options['header_logo_image_url']) : '',
			isset( $this->options['header_logo_image_url'] ) ? esc_attr( $this->options['header_logo_image_url']) : ''
		);
	}
	
	public function create_wrapped_header_checkbox() {
		printf(
			'<input type="checkbox" id="header_wrapped" name="encad_options[header_wrapped]" %s />',
			checked( isset( $this->options['header_wrapped'] ), true, false )
		);
	}
	
	/**
	* Menu
	*/
	
	public function create_menu_color_field() {
		printf(
			'<input type="text" id="menu_color" class="color-picker" name="encad_options[menu_color]" value="%s" style="background:%s" />',
			isset( $this->options['menu_color'] ) ? esc_attr( $this->options['menu_color']) : '#515151',
			isset( $this->options['menu_color'] ) ? esc_attr( $this->options['menu_color']) : '#515151'
		);
	}
	
	public function create_menu_height_field() {
		printf(
			'<input type="text" id="menu_height" name="encad_options[menu_height]" value="%s"/>px',
			isset( $this->options['menu_height'] ) ? esc_attr( $this->options['menu_height']) : '50'
		);
	}
	
	public function create_menu_border_color_field() {
		printf(
			'<input type="text" id="menu_border_color" class="color-picker" name="encad_options[menu_border_color]" value="%s" style="background:%s" />',
			isset( $this->options['menu_border_color'] ) ? esc_attr( $this->options['menu_border_color']) : '#161616',
			isset( $this->options['menu_border_color'] ) ? esc_attr( $this->options['menu_border_color']) : '#161616'
		);
	}
	
	public function create_menu_selected_item_color_field() {
		printf(
			'<input type="text" id="menu_selected_item_color" class="color-picker" name="encad_options[menu_selected_item_color]" value="%s" style="background:%s" />',
			isset( $this->options['menu_selected_item_color'] ) ? esc_attr( $this->options['menu_selected_item_color']) : '#337ab7',
			isset( $this->options['menu_selected_item_color'] ) ? esc_attr( $this->options['menu_selected_item_color']) : '#337ab7'
		);
	}
	
	public function create_menu_font_color_field() {
		printf(
			'<input type="text" id="menu_font_color" class="color-picker" name="encad_options[menu_font_color]" value="%s" style="background:%s" />',
			isset( $this->options['menu_font_color'] ) ? esc_attr( $this->options['menu_font_color']) : '#9d9d9d',
			isset( $this->options['menu_font_color'] ) ? esc_attr( $this->options['menu_font_color']) : '#9d9d9d'
		);
	}
	
	public function create_menu_font_active_color_field() {
		printf(
			'<input type="text" id="menu_font_active_color" class="color-picker" name="encad_options[menu_font_active_color]" value="%s" style="background:%s" />',
			isset( $this->options['menu_font_active_color'] ) ? esc_attr( $this->options['menu_font_active_color']) : '#ffffff',
			isset( $this->options['menu_font_active_color'] ) ? esc_attr( $this->options['menu_font_active_color']) : '#ffffff'
		);
	}
	
	public function create_menu_font_hover_color_field() {
		printf(
			'<input type="text" id="menu_font_hover_color" class="color-picker" name="encad_options[menu_font_hover_color]" value="%s" style="background:%s" />',
			isset( $this->options['menu_font_hover_color'] ) ? esc_attr( $this->options['menu_font_hover_color']) : '#ffffff',
			isset( $this->options['menu_font_hover_color'] ) ? esc_attr( $this->options['menu_font_hover_color']) : '#ffffff'
		);
	}
	
	/**
	* Dropdown-Menu
	*/
	
	public function create_dropdown_menu_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_color" class="color-picker" name="encad_options[dropdown_menu_color]" value="%s" style="background:%s" />',
			isset( $this->options['dropdown_menu_color'] ) ? esc_attr( $this->options['dropdown_menu_color']) : '#ffffff',
			isset( $this->options['dropdown_menu_color'] ) ? esc_attr( $this->options['dropdown_menu_color']) : '#ffffff'
		);
	}
	
	public function create_dropdown_menu_selected_item_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_selected_item_color" class="color-picker" name="encad_options[dropdown_menu_selected_item_color]" value="%s" style="background:%s" />',
			isset( $this->options['dropdown_menu_selected_item_color'] ) ? esc_attr( $this->options['dropdown_menu_selected_item_color']) : '#9d9d9d',
			isset( $this->options['dropdown_menu_selected_item_color'] ) ? esc_attr( $this->options['dropdown_menu_selected_item_color']) : '#9d9d9d'
		);
	}
	
	public function create_dropdown_menu_hover_item_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_hover_item_color" class="color-picker" name="encad_options[dropdown_menu_hover_item_color]" value="%s" style="background:%s" />',
			isset( $this->options['dropdown_menu_hover_item_color'] ) ? esc_attr( $this->options['dropdown_menu_hover_item_color']) : '#e8e8e8',
			isset( $this->options['dropdown_menu_hover_item_color'] ) ? esc_attr( $this->options['dropdown_menu_hover_item_color']) : '#e8e8e8'
		);
	}
	
	public function create_dropdown_menu_font_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_font_color" class="color-picker" name="encad_options[dropdown_menu_font_color]" value="%s" style="background:%s" />',
			isset( $this->options['dropdown_menu_font_color'] ) ? esc_attr( $this->options['dropdown_menu_font_color']) : '#515151',
			isset( $this->options['dropdown_menu_font_color'] ) ? esc_attr( $this->options['dropdown_menu_font_color']) : '#515151'
		);
	}
	
	public function create_dropdown_menu_font_active_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_font_active_color" class="color-picker" name="encad_options[dropdown_menu_font_active_color]" value="%s" style="background:%s" />',
			isset( $this->options['dropdown_menu_font_active_color'] ) ? esc_attr( $this->options['dropdown_menu_font_active_color']) : '#ffffff',
			isset( $this->options['dropdown_menu_font_active_color'] ) ? esc_attr( $this->options['dropdown_menu_font_active_color']) : '#ffffff'
		);
	}
	
	public function create_dropdown_menu_font_hover_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_font_hover_color" class="color-picker" name="encad_options[dropdown_menu_font_hover_color]" value="%s" style="background:%s" />',
			isset( $this->options['dropdown_menu_font_hover_color'] ) ? esc_attr( $this->options['dropdown_menu_font_hover_color']) : '#ffffff',
			isset( $this->options['dropdown_menu_font_hover_color'] ) ? esc_attr( $this->options['dropdown_menu_font_hover_color']) : '#ffffff'
		);
	}	
	
	/**
	* Main Page
	*/
	
	public function create_wrapped_website_checkbox() {
		printf(
			'<input type="checkbox" id="wrapped" name="encad_options[wrapped]" %s />',
			checked( isset( $this->options['wrapped'] ), true, false )
		);
	}
}

if( is_admin() )
    $template_settings = new encadTemplateOptions();