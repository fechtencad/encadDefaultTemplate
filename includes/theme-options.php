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
		
		add_settings_field(
			'header_height',
			'Header Height',
			array($this, 'create_header_height_field'),
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
			'main_color', // ID
			'Background Color', // Title
			array( $this, 'create_main_color_field'), // Callback
			'options-page', // Page
			'main_page_section' // Section
		);

		add_settings_field(
			'wrapped',
			'Wrapped Website',
			array( $this, 'create_wrapped_website_checkbox'),
			'options-page',
			'main_page_section'
		);
		
		add_settings_field(
			'widgets',
			'Amount Widgets',
			array( $this, 'create_widgets_select'),
			'options-page',
			'main_page_section'
		);
		
		// Footer
		
		add_settings_section(
            'footer_section', // ID
            'Footer', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        ); 
		
		add_settings_field(
			'footer_color', // ID
			'Background Color', // Title
			array( $this, 'create_footer_color_field'), // Callback
			'options-page', // Page
			'footer_section' // Section
		);
		
		add_settings_field(
			'footer_border_color', // ID
			'Border Color', // Title
			array( $this, 'create_footer_border_color_field'), // Callback
			'options-page', // Page
			'footer_section' // Section
		);	
		
		add_settings_field(
			'footer_font_color', // ID
			'Font Color', // Title
			array( $this, 'create_footer_font_color_field'), // Callback
			'options-page', // Page
			'footer_section' // Section
		);	

		// Insertions
		
		add_settings_section(
            'insertion_section', // ID
            'Insertions', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        ); 
		
		add_settings_field(
			'google_analytics', // ID
			'Google Analytics', // Title
			array( $this, 'create_google_analytics_field'), // Callback
			'options-page', // Page
			'insertion_section' // Section
		);	
		
		// Socials
		
		add_settings_section(
            'socials_section', // ID
            'Socials', // Title
            array( $this, 'print_section_info' ), // Callback
            'options-page' // Page
        ); 
		
		add_settings_field(
			'twitter', // ID
			'Twitter Link', // Title
			array( $this, 'create_twitter_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);			
		
		add_settings_field(
			'facebook', // ID
			'Facebook Link', // Title
			array( $this, 'create_facebook_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);	
		
		add_settings_field(
			'google_plus', // ID
			'Google+ Link', // Title
			array( $this, 'create_google_plus_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);	
		
		add_settings_field(
			'pinterest', // ID
			'Pinterest Link', // Title
			array( $this, 'create_pinterest_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);	

		add_settings_field(
			'youtube', // ID
			'Youtube Channel Link', // Title
			array( $this, 'create_youtube_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);	
		
		add_settings_field(
			'email', // ID
			'Email Address', // Title
			array( $this, 'create_email_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);	

		add_settings_field(
			'rss', // ID
			'RSS-Feed Link', // Title
			array( $this, 'create_rss_field'), // Callback
			'options-page', // Page
			'socials_section' // Section
		);	
		
		add_settings_field(
			'button_type', // ID
			'Social Button Style', // Title
			array( $this, 'create_button_type_select'), // Callback
			'options-page', // Page
			'socials_section' // Section
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
		
		if( isset( $input['header_height'] ) )
            $new_input['header_height'] = sanitize_text_field( $input['header_height'] );
		
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
		
		if( isset( $input['main_color'] ) )
            $new_input['main_color'] = sanitize_text_field( $input['main_color'] );
		
		if( isset( $input['widgets'] ) )
            $new_input['widgets'] = sanitize_text_field( $input['widgets'] );
		
		// Footer
		
		if( isset( $input['footer_color'] ) )
            $new_input['footer_color'] = sanitize_text_field( $input['footer_color'] );
		
		if( isset( $input['footer_font_color'] ) )
            $new_input['footer_font_color'] = sanitize_text_field( $input['footer_font_color'] );
		
		if( isset( $input['footer_border_color'] ) )
            $new_input['footer_border_color'] = sanitize_text_field( $input['footer_border_color'] );
		
		// Insertions
		
		if( isset( $input['google_analytics'] ) )
            $new_input['google_analytics'] = sanitize_text_field( $input['google_analytics'] );
		
		// Socials
		
		if( isset( $input['twitter'] ) )
            $new_input['twitter'] = sanitize_text_field( $input['twitter'] );
		
		if( isset( $input['facebook'] ) )
            $new_input['facebook'] = sanitize_text_field( $input['facebook'] );		
		
		if( isset( $input['google_plus'] ) )
            $new_input['google_plus'] = sanitize_text_field( $input['google_plus'] );
		
		if( isset( $input['pinterest'] ) )
            $new_input['pinterest'] = sanitize_text_field( $input['pinterest'] );
		
		if( isset( $input['youtube'] ) )
            $new_input['youtube'] = sanitize_text_field( $input['youtube'] );
		
		if( isset( $input['email'] ) )
            $new_input['email'] = sanitize_text_field( $input['email'] );
		
		if( isset( $input['rss'] ) )
            $new_input['rss'] = sanitize_text_field( $input['rss'] );
		
		if( isset( $input['button_type'] ) )
            $new_input['button_type'] = sanitize_text_field( $input['button_type'] );
		
        return $new_input;
    }


    /** 
     * Print the Section text
     */
    public function print_section_info() {
        print '<hr>Enter your settings below:';
    }
	
	/**
	* Header
	*/
	
	public function create_header_color_field() {
		printf(
			'<input type="text" id="header_color" class="color-picker" name="encad_options[header_color]" value="%s" style="background:%s" />default: #fff',
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
	
	public function create_header_height_field() {
		printf(
			'<input type="text" id="header_height" name="encad_options[header_height]" value="%s"/>px (default: 200px)',
			isset( $this->options['header_height'] ) ? esc_attr( $this->options['header_height']) : '200'
		);
	}
	
	/**
	* Menu
	*/
	
	public function create_menu_color_field() {
		printf(
			'<input type="text" id="menu_color" class="color-picker" name="encad_options[menu_color]" value="%s" style="background:%s" />default: #515151',
			isset( $this->options['menu_color'] ) ? esc_attr( $this->options['menu_color']) : '#515151',
			isset( $this->options['menu_color'] ) ? esc_attr( $this->options['menu_color']) : '#515151'
		);
	}
	
	public function create_menu_border_color_field() {
		printf(
			'<input type="text" id="menu_border_color" class="color-picker" name="encad_options[menu_border_color]" value="%s" style="background:%s" />default: #161616',
			isset( $this->options['menu_border_color'] ) ? esc_attr( $this->options['menu_border_color']) : '#161616',
			isset( $this->options['menu_border_color'] ) ? esc_attr( $this->options['menu_border_color']) : '#161616'
		);
	}
	
	public function create_menu_selected_item_color_field() {
		printf(
			'<input type="text" id="menu_selected_item_color" class="color-picker" name="encad_options[menu_selected_item_color]" value="%s" style="background:%s" />default: #666',
			isset( $this->options['menu_selected_item_color'] ) ? esc_attr( $this->options['menu_selected_item_color']) : '#666',
			isset( $this->options['menu_selected_item_color'] ) ? esc_attr( $this->options['menu_selected_item_color']) : '#666'
		);
	}
	
	public function create_menu_font_color_field() {
		printf(
			'<input type="text" id="menu_font_color" class="color-picker" name="encad_options[menu_font_color]" value="%s" style="background:%s" />default: #9d9d9d',
			isset( $this->options['menu_font_color'] ) ? esc_attr( $this->options['menu_font_color']) : '#9d9d9d',
			isset( $this->options['menu_font_color'] ) ? esc_attr( $this->options['menu_font_color']) : '#9d9d9d'
		);
	}
	
	public function create_menu_font_active_color_field() {
		printf(
			'<input type="text" id="menu_font_active_color" class="color-picker" name="encad_options[menu_font_active_color]" value="%s" style="background:%s" />default: #fff',
			isset( $this->options['menu_font_active_color'] ) ? esc_attr( $this->options['menu_font_active_color']) : '#ffffff',
			isset( $this->options['menu_font_active_color'] ) ? esc_attr( $this->options['menu_font_active_color']) : '#ffffff'
		);
	}
	
	public function create_menu_font_hover_color_field() {
		printf(
			'<input type="text" id="menu_font_hover_color" class="color-picker" name="encad_options[menu_font_hover_color]" value="%s" style="background:%s" />default: #fff',
			isset( $this->options['menu_font_hover_color'] ) ? esc_attr( $this->options['menu_font_hover_color']) : '#ffffff',
			isset( $this->options['menu_font_hover_color'] ) ? esc_attr( $this->options['menu_font_hover_color']) : '#ffffff'
		);
	}
	
	public function create_menu_height_field() {
		printf(
			'<input type="text" id="menu_height" name="encad_options[menu_height]" value="%s"/>px (default: 50px)',
			isset( $this->options['menu_height'] ) ? esc_attr( $this->options['menu_height']) : '50'
		);
	}
	
	/**
	* Dropdown-Menu
	*/
	
	public function create_dropdown_menu_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_color" class="color-picker" name="encad_options[dropdown_menu_color]" value="%s" style="background:%s" />default: #fff',
			isset( $this->options['dropdown_menu_color'] ) ? esc_attr( $this->options['dropdown_menu_color']) : '#ffffff',
			isset( $this->options['dropdown_menu_color'] ) ? esc_attr( $this->options['dropdown_menu_color']) : '#ffffff'
		);
	}
	
	public function create_dropdown_menu_selected_item_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_selected_item_color" class="color-picker" name="encad_options[dropdown_menu_selected_item_color]" value="%s" style="background:%s" />default: #337ab7',
			isset( $this->options['dropdown_menu_selected_item_color'] ) ? esc_attr( $this->options['dropdown_menu_selected_item_color']) : '#337ab7',
			isset( $this->options['dropdown_menu_selected_item_color'] ) ? esc_attr( $this->options['dropdown_menu_selected_item_color']) : '#337ab7'
		);
	}
	
	public function create_dropdown_menu_hover_item_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_hover_item_color" class="color-picker" name="encad_options[dropdown_menu_hover_item_color]" value="%s" style="background:%s" />default: #e8e8e8',
			isset( $this->options['dropdown_menu_hover_item_color'] ) ? esc_attr( $this->options['dropdown_menu_hover_item_color']) : '#e8e8e8',
			isset( $this->options['dropdown_menu_hover_item_color'] ) ? esc_attr( $this->options['dropdown_menu_hover_item_color']) : '#e8e8e8'
		);
	}
	
	public function create_dropdown_menu_font_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_font_color" class="color-picker" name="encad_options[dropdown_menu_font_color]" value="%s" style="background:%s" />default: #515151',
			isset( $this->options['dropdown_menu_font_color'] ) ? esc_attr( $this->options['dropdown_menu_font_color']) : '#515151',
			isset( $this->options['dropdown_menu_font_color'] ) ? esc_attr( $this->options['dropdown_menu_font_color']) : '#515151'
		);
	}
	
	public function create_dropdown_menu_font_active_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_font_active_color" class="color-picker" name="encad_options[dropdown_menu_font_active_color]" value="%s" style="background:%s" />default: #fff',
			isset( $this->options['dropdown_menu_font_active_color'] ) ? esc_attr( $this->options['dropdown_menu_font_active_color']) : '#ffffff',
			isset( $this->options['dropdown_menu_font_active_color'] ) ? esc_attr( $this->options['dropdown_menu_font_active_color']) : '#ffffff'
		);
	}
	
	public function create_dropdown_menu_font_hover_color_field() {
		printf(
			'<input type="text" id="dropdown_menu_font_hover_color" class="color-picker" name="encad_options[dropdown_menu_font_hover_color]" value="%s" style="background:%s" />default: #000',
			isset( $this->options['dropdown_menu_font_hover_color'] ) ? esc_attr( $this->options['dropdown_menu_font_hover_color']) : '#000',
			isset( $this->options['dropdown_menu_font_hover_color'] ) ? esc_attr( $this->options['dropdown_menu_font_hover_color']) : '#000'
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
	
	public function create_main_color_field() {
		printf(
			'<input type="text" id="main_color" class="color-picker" name="encad_options[main_color]" value="%s" style="background:%s" />default: #eee',
			isset( $this->options['main_color'] ) ? esc_attr( $this->options['main_color']) : '#eeeeee',
			isset( $this->options['main_color'] ) ? esc_attr( $this->options['main_color']) : '#eeeeee'
		);
	}

	public function create_widgets_select() {
			echo '<select id="widgets" name="encad_options[widgets]">';
				echo '<option value="0" '.selected( $this->options["widgets"], 0 ).'>0</option>';
				echo '<option value="1" '.selected( $this->options["widgets"], 1 ).'>1</option>';
				echo '<option value="2" '.selected( $this->options["widgets"], 2 ).'>2</option>';
				echo '<option value="3" '.selected( $this->options["widgets"], 3 ).'>3</option>';
				echo '<option value="4" '.selected( $this->options["widgets"], 4 ).'>4</option>';
			echo '</select>';
	}
	
	/**
	* Footer
	*/
	
	public function create_footer_color_field() {
		printf(
			'<input type="text" id="footer_color" class="color-picker" name="encad_options[footer_color]" value="%s" style="background:%s" />default: #515151',
			isset( $this->options['footer_color'] ) ? esc_attr( $this->options['footer_color']) : '#515151',
			isset( $this->options['footer_color'] ) ? esc_attr( $this->options['footer_color']) : '#515151'
		);
	}
	
	public function create_footer_font_color_field() {
		printf(
			'<input type="text" id="footer_font_color" class="color-picker" name="encad_options[footer_font_color]" value="%s" style="background:%s" />default: #fff',
			isset( $this->options['footer_font_color'] ) ? esc_attr( $this->options['footer_font_color']) : '#ffffff',
			isset( $this->options['footer_font_color'] ) ? esc_attr( $this->options['footer_font_color']) : '#ffffff'
		);
	}
	
	public function create_footer_border_color_field() {
		printf(
			'<input type="text" id="footer_border_color" class="color-picker" name="encad_options[footer_border_color]" value="%s" style="background:%s" />default: #5e5e5e',
			isset( $this->options['footer_border_color'] ) ? esc_attr( $this->options['footer_border_color']) : '#5e5e5e',
			isset( $this->options['footer_border_color'] ) ? esc_attr( $this->options['footer_border_color']) : '#5e5e5e'
		);
	}
	
	/**
	* Insertions
	*/
	
	public function create_google_analytics_field() {
		printf(
			'<input style="width: 40%%; height: 130px;" type="text" id="google_analytics" name="encad_options[google_analytics]" value="%s"/>
			<br>(place Google Analytics Code here)',
			isset( $this->options['google_analytics'] ) ? esc_attr( $this->options['google_analytics']) : ''
		);
	}
	
	/**
	* Socials
	*/
	
	public function create_twitter_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="twitter" name="encad_options[twitter]" value="%s"/>',
			isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
		);
	}
	
	public function create_facebook_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="facebook" name="encad_options[facebook]" value="%s"/>',
			isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
		);
	}	
	
	public function create_google_plus_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="google_plus" name="encad_options[google_plus]" value="%s"/>',
			isset( $this->options['google_plus'] ) ? esc_attr( $this->options['google_plus']) : ''
		);
	}
	
	public function create_pinterest_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="pinterest" name="encad_options[pinterest]" value="%s"/>',
			isset( $this->options['pinterest'] ) ? esc_attr( $this->options['pinterest']) : ''
		);
	}
	
	public function create_youtube_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="youtube" name="encad_options[youtube]" value="%s"/>',
			isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
		);
	}
	
	public function create_email_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="email" name="encad_options[email]" value="%s"/>',
			isset( $this->options['email'] ) ? esc_attr( $this->options['email']) : ''
		);
	}
	
	public function create_rss_field() {
		printf(
			'<input style="width: 40%%;" type="text" id="rss" name="encad_options[rss]" value="%s"/>',
			isset( $this->options['rss'] ) ? esc_attr( $this->options['rss']) : ''
		);
	}
	
	public function create_button_type_select() {
			$template_dir = get_template_directory_uri(); 
			echo '<select id="button_type" name="encad_options[button_type]">';
				echo '<option value="bright" '.selected( $this->options["button_type"], "bright" ).'>bright</option>';
				echo '<option value="dark" '.selected( $this->options["button_type"], "dark" ).'>dark</option>';
				echo '<option value="coloured" '.selected( $this->options["button_type"], "coloured" ).'>coloured</option>';
				echo '<option value="hex" '.selected( $this->options["button_type"], "hex" ).'>hex</option>';
			echo '</select>';
			printf(
				"
				</br>
				</br>
				<div>
				<img title='Twitter' src='$template_dir/img/".$this->options['button_type']."-socials/twitter.png' alt='Twitter' width='30' height='30' />
				<img title='Facebook' src='$template_dir/img/".$this->options['button_type']."-socials/facebook.png' alt='Facebook' width='30' height='30' />
				<img title='Google+' src='$template_dir/img/".$this->options['button_type']."-socials/googleplus.png' alt='Google+' width='30' height='30' />
				<img title='Pinterest' src='$template_dir/img/".$this->options['button_type']."-socials/pinterest.png' alt='Pinterest' width='30' height='30' />
				<img title='Youtube' src='$template_dir/img/".$this->options['button_type']."-socials/youtube.png' alt='Youtube' width='30' height='30' />
				<img title='Email' src='$template_dir/img/".$this->options['button_type']."-socials/email.png' alt='Email' width='30' height='30' />
				<img title='RSS' src='$template_dir/img/".$this->options['button_type']."-socials/rss.png' alt='RSS' width='30' height='30' />
				</div>
				<br>
				(Press 'Save Changes'-Button to update Icon-review)
				"
			);
	}

}

if( is_admin() )
    $template_settings = new encadTemplateOptions();