<?php
add_filter( 'wp_nav_menu_items', 'my_nav_menu_profile_link', 10, 2);
function my_nav_menu_profile_link($menu, $args) {      

			$cuenta= bp_get_loggedin_user_username();
			
			//MENU LOCATION, PRIMARY BY DEFAULT
			$type_menu = 'primary';
			//1 for active, 0 for deactivated
			$menu_config = array(
				'show_avatar'		=> '1',
				'show_profile'		=> '1',
				'show_messages'		=> '1',
				'show_friends'		=> '0',
				'show_groups'		=> '1',
				'show_config'		=> '1',
				'show_logout'		=> '1',				
			);
			$menu_names = array(
				'main_name'			=> bp_get_loggedin_user_username(), //default bp_get_loggedin_user_username() [gets_username]
				'profile'			=> 'Perfil',
				'friends'			=> 'Amigos',
				'messages'			=> 'Mensajes',
				'friends'			=> 'Amigos',
				'groups'			=> 'Grupos',
				'config'			=> 'Config',
				'logout'			=> 'Desconectar',
				
			);
			
			//get avatar
			$argmts = array( 
					'item_id' => bp_loggedin_user_id(),  
					'type' => 'thumb',  
					'width' => 30,  
					'height' => 16,  
					'html' => true,  
					'alt' => sprintf( __( 'Profile picture of %s', 'buddypress' ), bp_get_loggedin_user_fullname() ) 
			 ) ; 
			$avatar = bp_get_loggedin_user_avatar( $argmts );
			
			//main menu
			if(is_user_logged_in() && $args->theme_location == $type_menu){
					$profilelink = '<li id="menu-perfil" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown">';
					
					$profilelink .= '<a data-test="joie" id="cuentaid" href="#">';
					if($menu_config['show_avatar'] = '1'){
						$profilelink .= $avatar . ' ';
					}
					
					$profilelink .= $menu_names['main_name'] . '<strong class="caret"></strong></a><ul id="dropdown-menu" class="dropdown-menu">';
					
					if($menu_config['show_profile'] == '1'){
						$profilelink .= '<li class="bp-menu bp-profile-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="' . bp_loggedin_user_domain( '/' ) . '"> ' . $menu_names['profile'] . '</a></li>';
					}
					if($menu_config['show_friends'] == '1'){
						$profilelink .= '<li class="bp-menu bp-settings-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="' . bp_loggedin_user_domain( '/' ) . 'friends"> ' . $menu_names['friends'] . '</a></li>';
					}
					if($menu_config['show_messages'] == '1'){
						$profilelink .= '<li class="bp-menu bp-settings-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="' . bp_loggedin_user_domain( '/' ) . 'messages"> ' . $menu_names['messages'] . '</a></li>';
					}
					if($menu_config['show_groups'] == '1'){
						$profilelink .= '<li class="bp-menu bp-settings-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="' . bp_loggedin_user_domain( '/' ) . 'groups"> ' . $menu_names['groups'] . '</a></li>';
					}
					if($menu_config['show_config'] == '1'){
						$profilelink .= '<li class="bp-menu bp-settings-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="' . bp_loggedin_user_domain( '/' ) . 'config"> ' . $menu_names['config'] . '</a></li>';
					}
					if($menu_config['show_logout'] == '1'){
						$profilelink .= '<li class="bp-menu bp-logout-nav menu-item menu-item-type-custom menu-item-object-custom "><a href="' . wp_logout_url(site_url()) .'"> ' . $menu_names['logout'] . '</a></li>';
					}
					$profilelink .=	'</ul></li>';
					
					
					
					
					
					
			}
			$menu = $menu . $profilelink;
			return $menu;
}

?>