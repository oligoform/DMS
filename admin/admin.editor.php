<?php


class EditorAdmin {
	
	function __construct(){
		
		add_action( 'pagelines_options_dms_less', array( $this, 'dms_tools_less'), 10, 2 );
		add_action( 'pagelines_options_dms_scripts', array( $this, 'dms_scripts_template') );
		add_action( 'pagelines_options_dms_intro', array( $this, 'dms_intro') );
		add_action( 'pagelines_options_dms_debug', array( $this, 'dms_debug') );
		add_action( 'pagelines_options_pl_import', array( $this, 'pl_import') );
		add_action( 'pagelines_options_pl_export', array( $this, 'pl_export') );
	}
	
	function admin_array(){

		$d = array(
			'pagelines_settings' => array( 
				'title'		=> __( 'PageLines Settings', 'pagelines' ),
				'groups'	=> array(
					array(
						'title'	=> __( '<i class="pl-di pl-di-images"></i> Site Colors', 'pagelines' ), 
						'opts'	=> array(
							array(
								'key'		=> 'canvas_colors',
								'type' 		=> 'multi',
								'title' 	=> __( 'Site Base Colors', 'pagelines' ),
								'help' 		=> __( 'The "base" colors are a few standard colors used throughout DMS that plugins may use to calculate contrast or other colors to make sure everything looks great.', 'pagelines' ),
								'opts'		=> array(
									array(
										'key'			=> 'bodybg',
										'type'			=> 'color',
										'label' 		=> __( 'Background Base Color', 'pagelines' ),
										
										'compile'		=> 'pl-base',
									),
									array(
										'key'			=> 'text_primary',
										'type'			=> 'color',
										'label' 		=> __( 'Text Base Color', 'pagelines' ),
										
										'compile'		=> 'pl-text',

									),
									array(
										'key'			=> 'linkcolor',
										'type'			=> 'color',
										'label' 		=> __( 'Link Base Color', 'pagelines' ),
									
										'compile'		=> 'pl-link',
									)
								)
							),
						)
					),
					array(
						'title'	=> __( '<i class="pl-di pl-di-images"></i> Site Typography', 'pagelines' ), 
						'opts'	=> array(
							array(
								'type' 		=> 'multi',
								'title' 	=> __( 'Primary Type', 'pagelines' ),
								'help' 		=> __( 'The "base" colors are a few standard colors used throughout DMS that plugins may use to calculate contrast or other colors to make sure everything looks great.', 'pagelines' ),
								'opts'		=> array(
									array(
										'key'			=> 'font_primary',
										'type' 			=> 'typography',
										'label' 		=> __( 'Select Font Face', 'pagelines' ),
										'default'		=> 'open_sans',

									),
								)
							),
							array(
								'key'		=> 'canvas_colors',
								'type' 		=> 'multi',
								'title' 	=> __( 'Header Type', 'pagelines' ),
								'help' 		=> __( 'The "base" colors are a few standard colors used throughout DMS that plugins may use to calculate contrast or other colors to make sure everything looks great.', 'pagelines' ),
								'opts'		=> array(
									array(
										'key'			=> 'font_headers',
										'type' 			=> 'typography',
										'label' 		=> __( 'Select Font Face', 'pagelines' ),
										'default'		=> 'open_sans',

									),
								)
							),
							array(
								'title' 	=> __( 'Extra Google Fonts', 'pagelines' ),
								'key'			=> 'font_extra',
								'type' 			=> 'text',
								'label' 		=> __( 'Extra Google Fonts', 'pagelines' ),

							),
						)
					),
					array(
						'title'	=> __( '<i class="pl-di pl-di-images"></i> Site Images', 'pagelines' ), 
						'opts'	=> array(
							array(
								'key'			=> 'pagelines_favicon',
								'label'			=> __( 'Upload Favicon (32px by 32px)', 'pagelines' ),
								'type' 			=> 	'image_upload',
								'imgsize' 			=> 	'16',
								'extension'		=> 'ico,png', // ico support
								'title' 		=> 	__( 'Favicon Image', 'pagelines' ),
								'help' 			=> 	__( 'Enter the full URL location of your custom <strong>favicon</strong> which is visible in browser favorites and tabs.<br/> <strong>Must be .png or .ico file - 32px by 32px</strong>.', 'pagelines' ),
								'default'		=>  '[pl_parent_url]/images/default-favicon.png'
							),


							array(
								'key'			=> 'pl_login_image',
								'type' 			=> 	'image_upload',
								'col'			=> 2,
								'label'			=> __( 'Upload Login Image (80px Height)', 'pagelines' ),
								'imgsize' 			=> 	'80',
								'sizemode'		=> 'height',
								'title' 		=> __( 'Login Page Image', 'pagelines' ),
								'default'		=> '[pl_parent_url]/images/default-login-image.png',
								'help'			=> __( 'This image will be used on the login page to your admin. Use an image that is approximately <strong>80px</strong> in height.', 'pagelines' )
							),

							array(
								'key'			=> 'pagelines_touchicon',
								'col'			=> 3,
								'label'			=> __( 'Upload Touch Image (144px by 144px)', 'pagelines' ),
								'type' 			=> 	'image_upload',
								'imgsize' 			=> 	'72',
								'title' 		=> __( 'Mobile Touch Image', 'pagelines' ),
								'default'		=> '[pl_parent_url]/images/default-touch-icon.png',
								'help'			=> __( 'Enter the full URL location of your Apple Touch Icon which is visible when your users set your site as a <strong>webclip</strong> in Apple Iphone and Touch Products. It is an image approximately 144px by 144px in either .jpg, .gif or .png format.', 'pagelines' )
							),
						)
					),
					array(
						'title'	=> __( '<i class="pl-di pl-di-networking"></i> Layout Handling', 'pagelines' ), 
						'opts'	=> array(
							array(
								'key'		=> 'layout_opts',
								'type' 		=> 'multi',
								'title' 	=> __( 'Layout Configuration', 'pagelines' ),
								'opts' 		=> array(
									array(
										'key'		=> 'layout_mode',
										'type' 		=> 'select',
										'label' 	=> __( 'Select Content Width Mode', 'pagelines' ),
										'title' 	=> __( 'Layout Mode', 'pagelines' ),
										'opts' 		=> array(
											'pixel' 	=> array('name' => __( 'Pixel Width Based Layout', 'pagelines' )),
											'percent' 	=> array('name' => __( 'Percentage Width Based Layout', 'pagelines' ))
										),
										'default'	=> 'pixel',
									),
									array(
										'key'		=> 'layout_display_mode',
										'type' 		=> 'select',
										'label' 	=> __( 'Select Layout Display', 'pagelines' ),
										'title' 	=> __( 'Display Mode', 'pagelines' ),
										'opts' 		=> array(
											'display-full' 		=> array('name' => __( 'Full Width Display', 'pagelines' )),
											'display-boxed' 	=> array('name' => __( 'Boxed Display', 'pagelines' ))
										),
										'default'	=> 'display-full',
									),
								),
							),
						)
					), 
					array(
						'title'	=> __( '<i class="pl-di pl-di-networking"></i> Navigation', 'pagelines' ), 
						'opts'	=> array(
							array(

								'key'		=> 'layout_navigations',
								'col'		=> 2,
								'type' 		=> 'multi',
								'title' 	=> __( 'Default Navigation Setup', 'pagelines' ),
								'help'	 	=> __( 'These will be used in mobile menus and optionally other places throughout your site.', 'pagelines' ),
								'opts'	=> array(
									array(
										'key'		=> 'primary_navigation_menu',
										'type' 		=> 'select_menu',
										'label' 	=> __( 'Primary Navigation Menu', 'pagelines' ),


									),
									array(
										'key'		=> 'secondary_navigation_menu',
										'type' 		=> 'select_menu',
										'label' 	=> __( 'Secondary Navigation Menu', 'pagelines' ),

									),

									array(
										'key'		=> 'nav_dropdown_bg',
										'type' 		=> 'select',
										'label' 	=> __( 'Standard Nav Dropdown Background', 'pagelines' ),
										'default'	=> 'dark',
										'opts' 		=> array(
											'dark' 		=> array('name' => __( 'Dark Dropdowns', 'pagelines' )),
											'light' 	=> array('name' => __( 'Light Dropdowns', 'pagelines' ))
										),
									),

									array(
										'key'		=> 'nav_dropdown_toggle',
										'type' 		=> 'select',
										'label' 	=> __( 'Standard Nav Dropdown Toggle', 'pagelines' ),
										'default'	=> 'hover',
										'opts' 		=> array(
											'hover' 	=> array('name' => __( 'On Hover', 'pagelines' )),
											'click' 	=> array('name' => __( 'On Click', 'pagelines' ))
										),
									),

								),
							)
						)
					),
					array(
						'title'	=> __( '<i class="pl-di pl-di-share"></i> Social and Local', 'pagelines' ), 
						'opts'	=> array(
							array(
								'key'		=> 'karma_icon',
								'label'		=> __( 'Select icon for Social Counter', 'pagelines' ),
								'default'	=> 'sun',
								'title'		=> 'Social Counter',
								'type'		=> 'select_icon'
							),
							array(
								'key'		=> 'twittername',
								'type' 		=> 'text',
								'label' 	=> __( 'Your Twitter Username', 'pagelines' ),
								'title' 	=> __( 'Twitter Integration', 'pagelines' ),
								'help' 		=> __( 'This places your Twitter feed on the site. Leave blank if you want to hide or not use.', 'pagelines' )
							),
							array(
								'key'		=> 'fb_multi',
								'type'		=> 'multi', 
								'col'		=> 2,
								'title'		=> 'Facebook',
								'opts'		=> array(
									array(
										'key'		=> 'facebook_name',
										'type' 		=> 'text',
										'label' 	=> __( 'Your Facebook Page Name', 'pagelines' ),
										'title' 	=> __( 'Facebook Page', 'pagelines' ),
										'help' 		=> __( 'Enter the name component of your Facebook page URL. (For example, what comes after the facebook url: www.facebook.com/[name])', 'pagelines' )
									),
								)
							),

							array(
								'key'		=> 'site-hashtag',
								'type' 		=> 'text',
								'label' 	=> __( 'Your Website Hashtag', 'pagelines' ),
								'title' 	=> __( 'Website Hashtag', 'pagelines' ),
								'help'	 	=> __( 'This hashtag will be used in social media (e.g. Twitter) and elsewhere to create feeds.', 'pagelines' )
							),
						)
					)
				)
			), 
			'pagelines_scripts' => array( 
				'title'		=> __( 'Scripts', 'pagelines' ),
				
				'groups'	=> array(
					array(
						'title'	=> __( 'Website CSS and Scripts', 'pagelines' ),
						'desc'	=> __( 'Below are secondary fallbacks to the DMS code editors. You may need these if you create errors or issues on the front end.', 'pagelines' ),
						'opts'	=> array(
							array(
								'key'		=> 'custom_less',
								'type'		=> 'script_less',
								'title'		=> __( 'LESS/CSS Code', 'pagelines' ),
								'label'		=> __( 'Enter LESS/CSS Code', 'pagelines' ),
							),
							array(
								'key'		=> 'custom_scripts',
								'type'		=> 'script_html',
								'title'		=> __( 'Header Scripts', 'pagelines' ),
								'label'		=> __( 'Enter Header HTML/JS', 'pagelines' ),
							),
						)
					)
				)
			),
			'pagelines_import_export' => array( 
				'title'		=> __( 'Import / Export', 'pagelines' ),
				'hide_save'	=> true,
				'groups'	=> array(
								
					array(
						'title'	=> __( 'Import PageLines Data', 'pagelines' ),
						'desc'	=> __( 'Import a PageLines configuration for use on this site.', 'pagelines' ),
						'opts'	=> array(
							array(
								'type'	=> 'pl_import',
								'title'	=> __( 'Import Data', 'pagelines' )
							)
						)
					),
					array(
						'title'	=> __( 'Export PageLines Data', 'pagelines' ),
						'desc'	=> __( 'Export data from this site for import elsewhere.', 'pagelines' ),
						'opts'	=> array(
							array(
								'type'	=> 'pl_export',
								'title'	=> __( 'Export Data', 'pagelines' )
							)
						)
					),
					
				)
			),
			'pagelines_resets' => array( 
				'title'		=> __( 'Resets', 'pagelines' ),
				'hide_save'	=> true,
				'groups'	=> array(
					array(
						'type'	=> 'multi',
						'col'	=> 3,
						'title'	=> __( 'Resets', 'pagelines' ),
						'opts'	=> array(
							array(
									'key'		=> 'reset_global',
									'type'		=> 'action_button',
									'classes'	=> 'btn-important',
									'label'		=> __( '<i class="icon icon-undo"></i> Reset Global Settings', 'pagelines' ),
									'title'		=> __( 'Reset Global Site Settings', 'pagelines' ),
									'help'		=> __( "Use this button to reset all global settings to their default state. <br/><strong>Note:</strong> Once you've completed this action, you may want to publish these changes to your live site.", 'pagelines' )
							),
							array(
									'key'		=> 'reset_local',
									'type'		=> 'action_button',
									'classes'	=> 'btn-important',
									'label'		=> __( '<i class="icon icon-undo"></i> Reset Current Page Settings', 'pagelines' ),
									'title'		=> __( 'Reset Current Page Settings', 'pagelines' ),
									'help'		=> __( "Use this button to reset all settings on the current page back to their default state. <br/><strong>Note:</strong> Once you've completed this action, you may want to publish these changes to your live site.", 'pagelines' )
							),
							array(
									'key'		=> 'reset_type',
									'type'		=> 'action_button',
									'classes'	=> 'btn-important',
									'label'		=> __( '<i class="icon icon-undo"></i> Reset Current Post Type Settings', 'pagelines' ),
									'title'		=> __( 'Reset Current Post Type Settings', 'pagelines' ),
									'help'		=> __( "Use this button to reset all settings on the current post type back to their default state. <br/><strong>Note:</strong> Once you've completed this action, you may want to publish these changes to your live site.", 'pagelines' )
							),
							array(
									'key'		=> 'reset_cache',
									'col'		=> 2,
									'type'		=> 'action_button',
									'classes'	=> 'btn-info',
									'label'		=> __( '<i class="icon icon-trash"></i> Flush Caches', 'pagelines' ),
									'title'		=> __( 'Clear all CSS/LESS cached data.', 'pagelines' ),
									'help'		=> __( "Use this button to purge the stored LESS/CSS data. This will also clear cached pages if wp-super-cache or w3-total-cache are detected.", 'pagelines' )
							),
						)
					),
				)
			),
			
			'pagelines_advanced' => array( 
				'title'		=> __( 'Advanced', 'pagelines' ),
				'groups'	=> array(
								
					array(
						'title'	=> __( '<i class="pl-di pl-di-regions"></i> Region Control', 'pagelines' ),
						
						'opts'	=> array(
							array(
								'title'	=> 'Region Visibility',
								'type'	=> 'multi',
								'help'	=> __( 'Enable or disable various regions of your website from view.', 'pagelines' ),
								'opts'	=> array(
									array(
											'key'		=> 'region_disable_fixed',
											'type'		=> 'check',
											'label'		=> __( 'Disable Fixed Region?', 'pagelines' ),							  
									),
									array(
											'key'		=> 'region_disable_header',
											'type'		=> 'check',
											'label'		=> __( 'Disable Header Region?', 'pagelines' ),							  
									),
									array(
											'key'		=> 'region_disable_footer',
											'type'		=> 'check',
											'label'		=> __( 'Disable Footer Region?', 'pagelines' ),								  
									),
								)
							)
							
						)
					),
					array(
						'title'	=> __( 'Debug Options', 'pagelines' ),
						'opts'	=> array(
							array(
									'key'		=> 'enable_debug',
									'type'		=> 'check',
									'label'		=> __( 'Enable debug?', 'pagelines' ),
									'title'		=> __( 'PageLines debug', 'pagelines' ),
									'help'		=> sprintf( __( 'This information can be useful in the forums if you have a problem. %s', 'pagelines' ),
												   sprintf( '%s', ( pl_setting( 'enable_debug' ) ) ?
												   sprintf( '<br /><a href="%s" target="_blank">Click here</a> for your debug info.', site_url( '?pldebug=1' ) ) : '' ) )								  
							),
							array(
									'key'		=> 'disable_less_errors',
									'default'	=> false,
									'type'		=> 'check',
									'label'		=> __( 'Disable Error Notices?', 'pagelines' ),
									'title'		=> __( 'Less Notices', 'pagelines' ),
									'help'		=> __( 'Disable any error notices sent to wp-admin by the less system', 'pagelines' ),								  
							)
						)
					),
					array(
						'key'	=> 'misc_advanced_settings',
						'type'	=> 'multi',
						'col'	=> 3,
						'title'	=> __( 'Miscellaneous Config', 'pagelines' ),
						'opts'	=> array(
							array(
									'key'		=> 'load_prettify_libs',
									'type'		=> 'check',
									'label'		=> __( 'Enable Code Prettify?', 'pagelines' ),
									'title'		=> __( 'Google Prettify Code', 'pagelines' ),
									'help'		=> __( "Add a class of 'prettyprint' to code or pre tags, or optionally use the [pl_codebox] shortcode. Wrap the codebox shortcode using [pl_raw] if Wordpress inserts line breaks.", 'pagelines' )
							),
							array(
									'col'		=> 2,
									'key'		=> 'partner_link',
									'type'		=> 'text',
									'label'		=> __( 'Enter Partner Link', 'pagelines' ),
									'title'		=> __( 'PageLines Affiliate/Partner Link', 'pagelines' ),
									'help'		=> __( "If you are a <a target='_blank' href='http://www.pagelines.com/partners/'>PageLines Partner</a> enter your link here and the footer link will become a partner or affiliate link.", 'pagelines' )
							),
							array(
									'col'		=> 2,
									'key'		=> 'special_body_class',
									'type'		=> 'text',
									'label'		=> __( 'Install Class', 'pagelines' ),
									'title'		=> __( 'Current Install Class', 'pagelines' ),
									'help'		=> __( "Use this option to add a class to the &gt;body&lt; element of the website. This can be useful when using the same child theme on several installations or sub domains and can be used to control CSS customizations.", 'pagelines' )
							),

							array(
								'key'		=> 'alternative_css',
								'default'	=> false,
								'type'		=> 'check',
								'col'		=> 1,
								'label'		=> __( 'Enable Alternative CSS URLS', 'pagelines' ),
								'help'		=> __( 'Some hosts with aggressive caches have issues with the CSS files, this is a possible workaround.', 'pagelines' )				
							)
						)
					),
					
				)
			),
		);

		return $d;
	}
	
	function dms_intro(){

		?>
		<p><?php _e( 'Editing with DMS is done completely on the front end of your site. This allows you to customize in a way that feels more direct and intuitive than when using the admin.', 'pagelines' ); ?></p>
		<p><?php _e( 'Just visit the front end of your site (as an admin) and get started!', 'pagelines' ); ?>
		</p>
		<p><a class="button button-primary" href="<?php echo site_url(); ?>"><?php _e( 'Edit Site Using DMS', 'pagelines' ); ?>
		</a></p>
		
		<?php 
		
	}
		
	function pl_import(){
		$fileOpts = new EditorFileOpts;
		
		$show_child_import = ($fileOpts->file_exists()) ? true : false;
		
		
		
		?>
		
		<label class="checklist-label media" for="page_tpl_import">
			<div class="img"><input name="page_tpl_import" id="page_tpl_import" type="checkbox" checked /></div>
			<div class="bd">
				<div class="ttl"><?php _e( 'Import Page Templates', 'pagelines' ); ?>
				</div>
				<p><?php _e( 'Add new templates and overwrite ones with the same name.', 'pagelines' ); ?>
				</p>
			</div>
		</label>
		<label class="checklist-label media" for="global_import">
			<div class="img"><input name="global_import" id="global_import" type="checkbox" checked /></div>
			<div class="bd">
				<div class="ttl"><?php _e( 'Import New Global Settings', 'pagelines' ); ?>
				</div>
				<p><?php _e( 'Overwrite global settings with ones from this import.', 'pagelines' ); ?>
				</p>
			</div>
		</label>
		<label class="checklist-label media" for="type_import">
			<div class="img"><input name="type_import" id="type_import" type="checkbox" checked /></div>
			<div class="bd">
				<div class="ttl"><?php _e( 'Import Post Type Settings', 'pagelines' ); ?>
				</div>
				<p><?php _e( 'Overwrite post type settings with ones from this import.', 'pagelines' ); ?>
				</p>
			</div>
		</label>
		
	
		<span class="button button-primary pl-large-button fileinput-button import-button">
	        <i class="icon icon-plus"></i>
	        <span><?php _e( 'Select config file (.json)', 'pagelines' ); ?>
	        </span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileupload" type="file" name="files[]" multiple>
	    </span>
	
	
		<?php if($show_child_import):  ?>

			<label><?php _e( 'Child Theme Config Import', 'pagelines' ); ?>
			</label>

			<div class="child-import">
				<a href="#" data-action="reset_global_child" class="btn settings-action btn-warning"><i class="icon icon-download"></i> <?php _e( 'Load Child Theme Config', 'pagelines' ); ?></a>

				<div class="help-block">
					<?php _e( 'Reset theme settings using custom config file from child theme.<br />
					<strong>Note:</strong> Once you have completed this action, you may want to publish these changes to your live site.', 'pagelines' ); ?>
					
				</div>
			</div>
		<?php endif;?>
		<?php 
	}	
	
	function pl_export(){
	
		
		$tpls = new PLCustomTemplates;
		?>
		<div class="row">
		<div class="span6">
			<label class="label-standard"><?php _e( 'Select User Templates', 'pagelines' ); ?></label>
		
			<?php
		
			$btns = sprintf(
				'<div class="checklist-label checklist-btns">
					<button class="button checklist-tool" data-action="checkall"><i class="icon icon-ok"></i> %s</button> 
					<button class="button checklist-tool" data-action="uncheckall"><i class="icon icon-remove"></i> %s</button>
				</div>', __( 'Select All', 'pagelines' ), __( 'Deselect All', 'pagelines' ) );
		
			$tpl_selects = ''; 
			foreach( $tpls->get_all() as $index => $template){
			
				$tpl_selects .= sprintf(
					'<label class="checklist-label media" for="%s">
						<div class="img"><input name="templates[]%s" id="%s" type="checkbox" checked /></div>
						<div class="bd"><div class="ttl">%s</div><p>%s</p></div>
					</label>', 
					$index,
					$index,
					$index, 
					$template['name'], 
					$template['desc']
				);
			}
		
			printf('<fieldset>%s%s</fieldset>', $btns, $tpl_selects );
		
			?>
		</div>
		<div class="span6">
			<label class="label-standard"><?php _e( 'Global Settings', 'pagelines' ); ?></label>
			<label class="checklist-label media" for="export_global" name="export_global">
				<div class="img"><input name="export_global" id="export_global" type="checkbox" checked /></div>
				<div class="bd">
					<div class="ttl"><?php _e( 'Export Site Global Settings', 'pagelines' ); ?>
					</div>
					<p><?php _e( 'This will export your sites global settings. This includes everything in the options panel, as well as settings directed at sections in your "global" regions like your header and footer.', 'pagelines' ); ?>
					</p>
				</div>
			</label>
		
			<label class="label-standard"><?php _e( 'Post Type Settings', 'pagelines' ); ?>
			</label>
			<label class="checklist-label media" for="export_types">
				<div class="img"><input name="export_types" id="export_types" type="checkbox" checked /></div>
				<div class="bd">
					<div class="ttl"><?php _e( 'Export Post Type Settings', 'pagelines' ); ?>
					</div>
					<p><?php _e( 'This exports settings such as the template defaults for various post types.', 'pagelines' ); ?>
					</p>
				</div>
			</label>
		
			<label  class="label-standard"><?php _e( 'Theme Config Publishing', 'pagelines' ); ?>
			</label>
			<?php
			
				$publish_active = (is_child_theme() || pl_less_dev() ) ? true : false;
		
			?>
			<label class="checklist-label media <?php echo (!$publish_active) ? 'disabled': '';?>" for="publish_config">
				<div class="img"><input id="publish_config" name="publish_config" type="checkbox" <?php echo (!$publish_active) ? 'disabled="disabled"': '';?> /></div>
				<div class="bd">
					<div class="ttl"><?php echo (!$publish_active) ? __( '(Disabled! No child theme active)', 'pagelines' ): '';?> <?php _e( 'Publish Configuration to Child Theme (No Download File)', 'pagelines' ); ?>
					</div>
					<p><?php _e( 'Check this to publish your site configuration as a theme configuration file in your themes root directory. When a user activates your theme it will ask if it can overwrite their settings to attain a desired initial experience to the theme.', 'pagelines' ); ?>
					</p>
				</div>
			</label>
		
			<div class="center publish-button">
				<button class="button button-primary pl-large-button settings-action" data-action="opt_dump"><?php _e( 'Publish', 'pagelines' ); ?>
				 <span class="spamp">&amp;</span> <?php _e( 'Download DMS Config', 'pagelines' ); ?>
				 </button>
			</div>
		</div>
	</div>
		<?php
		
		
	}
		
	function dms_tools_less( $o ){
		
		?>
		<div class="label-standard" for="pl-dms-less-form">Enter LESS/CSS Code</div>
		<form id="pl-dms-less-form" class="dms-update-setting" data-setting="custom_less">		
			<textarea id="pl-dms-less" name="pl-dms-less" class="html-textarea code_textarea input_custom_less large-text" data-mode="less"><?php echo pl_setting('custom_less');?></textarea>
		</form>		
		<?php 
		
	}
	
	function dms_scripts_template( $o ){
		
		?>
		<div class="label-standard" for="pl-dms-scripts-form">Enter Header HTML/JS</div>
			<form id="pl-dms-scripts-form" class="dms-update-setting" data-setting="custom_scripts">
				<textarea id="pl-dms-scripts" name="pl-dms-scripts" class="html-textarea code_textarea input_custom_scripts large-text" data-mode="htmlmixed"><?php echo stripslashes( pl_setting( 'custom_scripts' ) );?></textarea>
			</form>
		<?php
	}
	
	function dms_debug() {
		?>
		<form id="pl-dms-debug-form" class="dms-update-setting" data-setting="enable_debug" data-type="check">
			
			<input type="checkbox" name="enable_debug" class="input_enable_debug" <?php checked( pl_setting( 'enable_debug' ), 1 ); ?> />
			<input class="button button-primary" type="submit" value="<?php _e( 'Update', 'pagelines' ); ?>
			" /><span class="saving-confirm"></span>
		</form>
		<?php
	}
}