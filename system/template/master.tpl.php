<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="<?=$content['meta_description']?>">
	<title><?=$content['title']?></title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:title" content="Top4 - The New Australian Social Business Directory">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.top4.com.au/">
	<meta property="og:image" content="http://www.top4.com.au/custom/domain_1/theme/top4/images/logo-bottom.png">
	<meta property="og:locale" content="en_AU">

	<meta name="robots" content="noindex, nofollow">
    
    <base href="http://localhost/allen_frame_trial/" >

	<!-- CSS -->
	<link href="content/css/default.css" rel="stylesheet" type="text/css">

	<!-- Script -->
	<script src="content/js/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="content/js/default.js" type="text/javascript"></script>

</head>
<body>
<div id="off_canvas_wrapper" class="wrapper">
	<div id="off_canvas_container" class="wrapper">
    	<div id="off_canvas_container_mask" class="off_canvas_halt"></div>
		<div id="off_canvas_menu">
        	<div id="off_canvas_menu_section_nav" class="off_canvas_menu_section">
                <div id="off_canvas_menu_section_nav_item_1" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/"><span>Home</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_2" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/listing/"><span>Businesses</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_3" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/job/"><span>Jobs</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_4" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/product/"><span>Products</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_5" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/feed/friends/find/"><span>People</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_6" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/pressrelease/"><span>Press Releases</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_7" class="off_canvas_menu_item">
                    <a href="http://stg.top4.com.au/feed/all-updates/"><span>Newsfeeds</span></a>
                </div>
            </div><!-- #off_canvas_menu_section_main_menu -->
        	<div id="off_canvas_menu_section_sign_in" class="off_canvas_menu_section">
                <div id="off_canvas_menu_section_sign_in_item_1" class="off_canvas_menu_item">
                    <a href="#">Sign Up</a>
                </div>
                <div id="off_canvas_menu_section_sign_in_item_2" class="off_canvas_menu_item">
                    <a href="#">Sign In</a>
                </div>
            </div>
		</div><!-- #off_canvas_menu -->
        <div id="header_wrapper" class="wrapper">
            <div id="top_wrapper" class="wrapper">
                <div id="top_wrapper_off_canvas_trigger" class="off_canvas_trigger"></div>
                <div id="top_wrapper_logo"><a href="/"><img src="content/image/the-new-australian-social-business-directory_logo_small.png" alt="Top4 - The New Australian Social Business Directory"></a></div>
                <div id="top_wrapper_search_trigger" class="search_trigger"></div>
            </div><!-- #top_wrapper -->
            <div id="search_wrapper" class="wrapper">
                <div id="search_container" class="container">
                    <div id="search_wrapper_close" class="search_halt"></div>
                    <div id="search_keyword_container" class="search_form_row">
                        <label for="search_keyword">What are you looking for?</label>
                        <input name="keyword" type="text" placeholder="What are you looking for?" id="search_keyword" class="general_style_input_text">
                        <input name="category_id" type="hidden">
                    </div>
                    <div id="search_location_container" class="search_form_row">
                        <label for="search_location">In which Suburb?</label>
                        <input name="location" type="text" placeholder="In which Suburb?" id="search_location" class="general_style_input_text">
                        <input name="location_id" type="hidden">
                        <input name="geo_location" type="hidden">
                    </div>
                    <div id="search_submit_container" class="search_form_row">
                        <a id="search_submit" class="general_style_input_button general_style_input_button_orange"><span>Search</span></a>
                    </div>
                </div>
            </div><!-- #search_wrapper -->
            <div id="banner_wrapper" class="wrapper">
                <div id="banner_mask"></div>
                <div id="banner_container" class="container">
                    <p id="banner_title">Find a business</p>
                    <p id="banner_slogan">Find, share, promote and connect with top business in your area like never before</p>
                </div>
            </div><!-- #banner_wrapper -->
            <div id="action_button_wrapper" class="wrapper">
                <a href="javascript:void(0);" id="action_button_sign_up" class="action_button"><span class="font_icon font_icon_plus general_style_gradient_bg_orange"></span><span class="text">ADD YOUR BUSINESS</span></a>
            </div><!-- #action_button_wrapper -->
        </div><!-- #header_wrapper -->
  	    <div id="body_wrapper" class="wrapper">
            <div id="home_featured_listing_container" class="content_section container">
            	<div class="content_section_title">Featured</div>
                <div class="content_section_body">
                	<div class="listing_block">
                    </div>
                </div>
            </div>
        </div><!-- #body_wrapper -->
        <div id="footer_wrapper" class="wrapper">
        </div><!-- #footer_wrapper -->


		<div id="test_wrapper" class="wrapper system_debug">
			<div id="top_logo_wrapper" class="wrapper">
				<div id="top_logo_container" class="container">
					<div id="top_logo"><a href="/"><img src="content/image/the-new-australian-social-business-directory.png" alt="Top4 - The New Australian Social Business Directory"></a></div><!-- #top_logo -->
					<div id="top_search_container"></div><!-- #top_search_container -->
					<div class="clear"><!-- --></div>
				</div><!-- #top_logo_container -->
			</div><!-- #top_logo_wrapper -->
			<div id="top_navigation_wrapper" class="wrapper">
				<div id="top_navigation_container" class="container">
					<ul id="top_navigation">
						<li id="nav_header_2" class="active">
							<a class="2" href="http://stg.top4.com.au/"><span>Home</span></a>
						</li>
						<li id="nav_header_3">
							<a class="3" href="http://stg.top4.com.au/listing/"><span>Businesses</span></a>
						</li>
						<li id="nav_header_4">
							<a class="4" href="http://stg.top4.com.au/job/"><span>Jobs</span></a>
						</li>
						<li id="nav_header_5">
							<a class="5" href="http://stg.top4.com.au/product/"><span>Products</span></a>
						</li>
						<li id="nav_header_6">
							<a class="6" href="http://stg.top4.com.au/feed/friends/find/"><span>People</span></a>
						</li>
						<li id="nav_header_7">
							<a class="7" href="http://stg.top4.com.au/pressrelease/"><span>Press Releases</span></a>
						</li>
						<li id="nav_header_8">
							<a class="8" href="http://stg.top4.com.au/feed/all-updates/"><span>Newsfeeds</span></a>
						</li>
					</ul>
					<div id="top_navigation_call_to_action_button">
						<a href="http://stg.top4.com.au/members/login.php" title="Add Your Business" id="top_navigation_call_to_action_button_register">Add Your Business</a>
					</div>
					<div id="top_user_accesses"><!--
					 --><div id="top_user_access_sign_up" class="top_user_access expand_parent">
							<div class="top_user_access_expand_trigger expand_trigger"><a id="close_top_user_access" href="javascript:void(0)">Sign Up</a></div>
							<div class="top_user_access_expand_wrapper expand_wrapper">
								<div class="top_user_access_expand_container expand_container">
									<div id="top_user_access_sign_up_facebook" class="top_user_access_button_container top_user_access_button_container_facebook">
										<a href="/facebook_login.php" class="pop_up top_user_access_button" target="_blank">Sign up with Facebook</a>
									</div>
									<div id="top_user_access_sign_up_linkedin" class="top_user_access_button_container top_user_access_button_container_linkedin">
										<a href="/linkedin_login.php" class="pop_up top_user_access_button" target="_blank">Sign up with LinkedIn</a>
									</div>
									<div id="top_user_access_sign_up_googleplus" class="top_user_access_button_container top_user_access_button_container_googleplus">
										<a href="/googleplus_login.php" class="pop_up top_user_access_button" target="_blank">Sign up with Google Plus</a>
									</div>
									<div id="top_user_access_sign_up_email" class="top_user_access_button_container top_user_access_button_container_email">
										<a href="http://stg.top4.com.au/members/login.php" class="top_user_access_button">Sign up with Email</a>
									</div><!-- #page_top_sign_in_button_top4 -->
									<div class="top_user_access_expand_close expand_close">
										<span></span>
									</div>
								</div>						
							</div>
						</div><!-- #top_user_access_sign_up --><!--
					 --><div id="top_user_access_sign_in" class="top_user_access expand_parent">
							<div class="top_user_access_expand_trigger expand_trigger"><a href="javascript:void(0)">Sign In</a></div>
							<div class="top_user_access_expand_wrapper expand_wrapper">
								<div class="top_user_access_expand_container expand_container">
									<div id="top_user_access_sign_in_facebook" class="top_user_access_button_container top_user_access_button_container_facebook">
										<a href="/facebook_login.php" class="pop_up top_user_access_button" target="_blank">Sign in with Facebook</a>
									</div>
									<div id="top_user_access_sign_in_linkedin" class="top_user_access_button_container top_user_access_button_container_linkedin">
										<a href="/linkedin_login.php" class="pop_up top_user_access_button" target="_blank">Sign in with LinkedIn</a>
									</div>
									<div id="top_user_access_sign_in_googleplus" class="top_user_access_button_container top_user_access_button_container_googleplus">
										<a href="/googleplus_login.php" class="pop_up top_user_access_button" target="_blank">Sign in with Google Plus</a>
									</div>
									<div id="top_user_access_sign_in_email" class="top_user_access_button_container top_user_access_button_container_email expand_parent">
										<div class="top_user_access_expand_trigger expand_trigger top_user_access_button">Sign in with Email</div>
										<div class="top_user_access_expand_wrapper expand_wrapper">
											<div class="top_user_access_expand_container expand_container">
												<form class="form_value_hint" method="post" action="http://stg.top4.com.au/members/login.php">
													<div class="page_top_sign_in_form_row">
														<input id="page_top_sign_in_form_email" name="username" type="text" title="Your Email" value="" placeholder="Your Email">
													</div>
													<div class="page_top_sign_in_form_row">
														<input id="page_top_sign_in_form_password" name="password" type="password" value="" title="Your Password" placeholder="Your Password">
													</div>
													<!-- div id="page_top_sign_in_form_keep_signed_in_row" class="page_top_sign_in_form_row">
														<input id="page_top_sign_in_form_keep_signed_in" type="checkbox" name="automatic_login">
														<label for="page_top_sign_in_form_keep_signed_in">Keep me signed in</label>
													</div -->
													<div class="page_top_sign_in_form_row">
														<input id="page_top_sign_in_form_submit" class="button_face button_face_gray" type="submit" value="Sign In">
													</div>
												</form>
											</div>
										</div>
									</div><!-- #page_top_sign_in_button_top4 -->
									<div class="top_user_access_expand_close expand_close">
										<span></span>
									</div>
								</div>						
							</div>
						</div><!-- #top_user_access_sign_in --><!--
				 --></div><!-- #top_user_accesses -->
					<div class="clear"><!-- --></div>
				</div><!-- #top_navigation_container -->
			</div><!-- #top_navigation_wrapper -->
		</div>
	</div>
</div>
</body>
</html>
