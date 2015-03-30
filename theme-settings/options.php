<?php 
		/* ---------------------------------------------------------
		General section
		----------------------------------------------------------- */
		$theme_options[] = array(
								"name" => "General", 
								"id" => "general", 
								"icon" => $this->plugin_url."/images/settings.png", 
								"open" => true, 
								"options" => array(
									array( 
										"name" => "Logo URL",
										"desc" => "Enter the link to your logo image",
										"id" => $prefix."logo",
										"type" => "upload",
										"std" => $this->template_url ."/images/logo.png"
									),
									array( 
										"name" => "Custom Favicon",
										"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
										"id" => $prefix."favicon",
										"type" => "text",
										"std" => $this->template_url ."/images/favicon.ico"
									)
		
								)
						);   
		/* ---------------------------------------------------------
		Home section
		----------------------------------------------------------- */
		$theme_options[] = array(
								"name" => "Homepage", 
								"id" => "homepage", 
								"icon" => $this->plugin_url."/images/settings.png", 
								"open" => true, 
								"options" => array(
									array(
										"name" => "Welcome Text",
										"desc" => "Welcome text on the home page slider.",
										"id" => $prefix."welcome_text",
										"type" => "wysiwyg",
										"std" => ""
									),
									array( 
										"name" => "Slider Image URL 1",
										"desc" => "Upload a image for slider",
										"id" => $prefix."slider_1",
										"type" => "upload",
										"std" => ""
									),
									array( 
										"name" => "Slider Image URL 2",
										"desc" => "Upload a image for slider",
										"id" => $prefix."slider_2",
										"type" => "upload",
										"std" => ""
									),
									array( 
										"name" => "Slider Image URL 3",
										"desc" => "Upload a image for slider",
										"id" => $prefix."slider_3",
										"type" => "upload",
										"std" => ""
									),
									array( 
										"name" => "Slider Image URL 4",
										"desc" => "Upload a image for slider",
										"id" => $prefix."slider_4",
										"type" => "upload",
										"std" => ""
									),
									array( 
										"name" => "Slider Image URL 5",
										"desc" => "Upload a image for slider",
										"id" => $prefix."slider_5",
										"type" => "upload",
										"std" => ""
									),
		
								)
						);  
		/* ---------------------------------------------------------
		Header section
		----------------------------------------------------------- */
		$theme_options[] = array(
								"name" => "Header", 
								"id" => "header", 
								"icon" => $this->plugin_url."/images/settings.png", 
								"open" => true, 
								"options" => array(
									array(
										"name" => "Header Phone Number",
										"desc" => "Phone number for calling.",
										"id" => $prefix."header_phone",
										"type" => "text",
										"std" => "",
										"placeholder" => "+441214960018"
									),
									array(
										"name" => "Header Phone Number Text formatted",
										"desc" => "Phone number for display in header.",
										"id" => $prefix."header_phone_text",
										"type" => "text",
										"std" => "",
										"placeholder" => "+44 121 496 0018"
									),
									array(
										"name" => "Header Email",
										"desc" => "Email for display in header.",
										"id" => $prefix."email_link",
										"type" => "text",
										"std" => "#"
									)
		
								)
		);
		/* ---------------------------------------------------------
		Footer section
		----------------------------------------------------------- */
		$theme_options[] = array(
								"name" => "Footer", 
								"id" => "footer", 
								"icon" => $this->plugin_url."/images/settings.png", 
								"open" => true, 
								"options" => array(
									array(
										"name" => "Footer Credit",
										"desc" => "You can customize footer credit on footer area her.",
										"id" => $prefix."footer_text",
										"type" => "textarea",
										"std" => ""
									)
		
								)
		);
		/* ---------------------------------------------------------
		Socials section
		----------------------------------------------------------- */
		$theme_options[] = array(
								"name" => "Socials",
								"id" => "socials", 
								"icon" => $this->plugin_url."/images/settings.png", 
								"open" => true, 
								"options" => array(
									array(
										"name" => "Facebook link:",
										"desc" => "You can customize footer credit on footer area her.",
										"id" => $prefix."faceboox_link",
										"type" => "text",
										"std" => ""
									),
									array(
										"name" => "Pinterest link:",
										//"desc" => "You can customize footer credit on footer area her.",
										"id" => $prefix."pinterest_link",
										"type" => "text",
										"std" => ""
									),
									array(
										"name" => "Twitter link:",
										//"desc" => "You can customize footer credit on footer area her.",
										"id" => $prefix."twitter_link",
										"type" => "text",
										"std" => ""
									)
		
								)
		);  

