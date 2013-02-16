<?php


class EditorTypography{
	
	var $default_font = '"Helvetica", Arial, serif';
	var $import_fonts = array();
	
	function __construct( PageLinesFoundry $foundry ){
		
		$this->foundry = $foundry;
		
 		add_filter('pl_settings_array', array(&$this, 'add_type_settings'));
		add_filter('pless_vars', array(&$this, 'global_type_vars'));
		add_action('wp_head', array(&$this, 'add_google_imports'));
	}
	
	function global_type_vars( $vars ){
		
		$vars['plFontSize'] = sprintf( '%spx', pl_setting('base_font_size', array('default' => '14')) ); 
	
		// Base Font
		$primary = $this->import_fonts[] = pl_setting('font_primary');
		$vars['plBaseFont'] = $this->foundry->get_stack( $primary ); 
		$vars['plBaseWeight'] = pl_setting('font_primary_weight', array('default' => 'normal')); 
		
		// Alt Font
		$alt = $this->import_fonts[] = pl_setting('font_secondary');
		$vars['plAltFont'] = $this->foundry->get_stack( pl_setting('font_secondary') ); 
		$vars['plAltWeight'] = pl_setting('font_secondary_weight', array('default' => 'normal')); 

		// Headers Font
		$alt = $this->import_fonts[] = pl_setting('font_headers');
		$vars['plHeaderFont'] = $this->foundry->get_stack( pl_setting('font_headers') ); 
		$vars['plHeaderWeight'] = pl_setting('font_headers_weight', array('default' => 'bold')); 
		
		return $vars;
	}
	
	function add_google_imports(){
		
		$import = $this->foundry->google_import( $this->import_fonts ); 
		
		printf('<style id="master_font_import" type="text/css">%2$s%1$s</style>%2$s', $import, "\n");
	}
	
	function add_type_settings( $settings ){
		
		$settings['typography'] = array(
				'name' 	=> 'Typography', 
				'icon'	=> 'icon-font',
				'pos'	=> 3,
				'opts' 	=> $this->type_options()
		);
		
		return $settings;
	}
	
	function type_options(){
		
		$settings = array(
			array(
				'key'			=> 'base_font_size',
				'type'			=> 'count_select',
				'count_start'	=> 10, 
				'count_number'	=> 50,
				'suffix'		=> 'px',
				'title'			=> __( 'Base Font Size', 'pagelines' ),
				'help'			=> __( 'Select the base font size in pixels that all typographical elements will be based on.', 'pagelines' ),
				'default'		=> 14 
			),
			array(
				'type' 	=> 	'multi',
				'title' 		=> __( 'Primary Text', 'pagelines' ),						
				'help' 		=> __( 'Configure the typography for the text headers across your site. The base font size is a reference that will be scaled and used throughout the site.', 'pagelines' ),
				'opts'	=> array(
					array(
						'key'			=> 'font_primary',
						'type' 			=> 'type', 
						'label' 		=> 'Header Font', 
						'default'		=> 'helvetica'
					), 
					array(
						'key'			=> 'font_primary_weight',
						'type' 			=> 'select', 
						'classes'		=> 'font-weight',
						'label'			=> 'Font Weight', 
						'opts'			=> array(
							'normal'	=> array('name' => 'Normal'),
							'bold'		=> array('name' => 'Bold')
						),
						'default' 		=> 'normal'
					),
				),
				
			),
			array(
				'type' 	=> 	'multi',
				'title' 		=> __( 'Header Elements', 'pagelines' ),						
				'help' 		=> __( 'Configure the typography for the text headers across your site. The base font size is a reference for &lt;H6&gt; that all text headers will use as a basis.', 'pagelines' ),
				'opts'	=> array(
					array(
						'key'			=> 'font_headers',
						'type' 			=> 'type', 
						'label' 		=> 'Header Font', 
						'default'		=> 'helvetica'
					), 
					array(
						'key'			=> 'font_headers_weight',
						'type' 			=> 'select', 
						'classes'			=> 'font-weight',
						'label'			=> 'Font Weight', 
						'opts'			=> array(
							'normal'	=> array('name' => 'Normal'),
							'bold'		=> array('name' => 'Bold')
						),
						'default' 		=> 'bold'
					)
				),
				
			),
			
			array(
				'type' 	=> 	'multi',
				'title' 		=> __( 'Secondary Text', 'pagelines' ),						
				'help' 		=> __( 'Configure the typography for secondary text throughout your site. This font may be used in sub headers, or other various elements to add contrast.', 'pagelines' ),
				'opts'	=> array(
					array(
						'key'			=> 'font_secondary',
						'type' 			=> 'type', 
						'label' 		=> 'Header Font', 
						'default'		=> 'helvetica'
					), 
					array(
						'key'			=> 'font_secondary_weight',
						'type' 			=> 'select', 
						'label'			=> 'Font Weight', 
						'classes'			=> 'font-weight',
						'opts'			=> array(
							'normal'	=> array('name' => 'Normal'),
							'bold'		=> array('name' => 'Bold')
						),
						'default' 		=> 'normal'
					),
				),
				
			),
			
		);
	
			
		return $settings;
		
	}
	
}





