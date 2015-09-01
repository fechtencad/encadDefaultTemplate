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
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Theme Optionen', 
            'manage_options', 
            'options-page', 
            array( $this, 'create_encad_template_options_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_encad_template_options_page()
    {
        // Set class property
        $this->options = get_option( 'options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?><h2>Theme Einstellungen für <?php bloginfo('name'); ?></h2>           
            <form method="post" action="theme-options.php">
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
            'options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'headerSection', // ID
            'encad Theme Optionen', // Title
            array( $this, 'printSectionInfo' ), // Callback
            'options-page' // Page
        );  
		
		add_settings_field (
			'color-picker', // ID
			'Header Color', // Title
			array( $this, 'createColorSection'), // Callback
			'options-page',
			'headerSection' // Section
		);
		
		/**

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'options-page', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'options-page', 
            'setting_section_id'
        );    
		*/
    }

    /** 
     * Print the Section text
     */
    public function printSectionInfo() {
        print 'Geben Sie Ihre Einstellungen für das Template der encad consulting GmbH hier ein:';
    }
	
    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="options[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }
	
	
	public function createColorSection() {
		?>
		Color: <input type="text" class="color-picker" name="options[color-picker]" id='color-picker' value="#cc0000" />
		<?php
	}
	
	

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback() {
        printf(
            '<input type="text" id="title" name="options[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
	
	public function get_options() {
		return $options;
	}
}

if( is_admin() )
    $template_settings = new encadTemplateOptions();