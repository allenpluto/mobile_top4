<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allen Wu">
    <meta name="keywords" content="[[*meta_keywords]]">
    <meta name="description" content="[[*description]]">
    <title>[[*name]]</title>
    <base href="[[*base]]" >

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="[[*robots]]">

    [[+style]]
</head>
<body>
<div id="off_canvas_wrapper" class="wrapper">
    <div id="off_canvas_container" class="wrapper">
        <div id="off_canvas_container_mask" class="off_canvas_halt"></div>
        <div id="off_canvas_menu">
            <div class="off_canvas_menu_section">
                <div id="off_canvas_menu_section_nav_item_1" class="off_canvas_menu_item">
                    <a href=""><span>Home</span></a>
                </div>
                <div id="off_canvas_menu_section_business_item_1" class="off_canvas_menu_item">
                    <a href="listing/">Popular Categories</a>
                </div>
                <div id="off_canvas_menu_section_nav_item_2" class="off_canvas_menu_item">
                    <a href="about-us"><span>About Us</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_3" class="off_canvas_menu_item">
                    <a href="http://www.top4marketing.com.au/package-top4-platform/"><span>Add Your Business</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_4" class="off_canvas_menu_item">
                    <a href="advertise-with-us"><span>Advertise with Us</span></a>
                </div>
            </div><!-- #off_canvas_menu_section_main_menu -->
            <div id="" class="off_canvas_menu_section">
                <div id="off_canvas_menu_section_nav_item_5" class="off_canvas_menu_item">
                    <a href="privacy-policy"><span>Privacy Policy</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_6" class="off_canvas_menu_item">
                    <a href="terms-conditions"><span>Terms & Conditions</span></a>
                </div>
            </div>
        </div><!-- #off_canvas_menu -->
        <div id="header_wrapper" class="wrapper">
            <div id="top_wrapper" class="wrapper">
                <div id="top_wrapper_off_canvas_trigger" class="off_canvas_trigger"></div>
                <div id="top_wrapper_logo"><a href="./"><svg width="80" height="40"><image xlink:href="content/image/the-new-australian-social-business-directory_logo.svg" src="content/image/the-new-australian-social-business-directory_logo_small.png" alt="Top4 - The New Australian Social Business Directory" width="80" height="40" /></svg></a></div>
                <div id="top_wrapper_search_trigger" class="search_trigger"></div>
            </div><!-- #top_wrapper -->
            <div id="search_wrapper" class="wrapper">
                <div id="search_container" class="container">
                    <div id="search_wrapper_close" class="search_halt"></div>
                    <div id="search_keyword_container" class="search_form_row">
                        <label for="search_keyword">What are you looking for?</label>
                        <input name="keyword" type="text" placeholder="What are you looking for?" id="search_keyword" class="general_style_input_text" value="[[&search_what]]">
                        <input name="category_id" type="hidden">
                    </div>
                    <div id="search_location_container" class="search_form_row">
                        <label for="search_location">In which Suburb?</label>
                        <input name="location" type="text" placeholder="In which Suburb?" id="search_location" class="general_style_input_text" value="[[&search_where]]">
                        <input name="location_id" type="hidden" id="search_location_place_id">
                        <input name="geo_location" type="hidden" id="search_location_geometry_location">
                    </div>
                    <div id="search_submit_container" class="search_form_row">
                        <a id="search_submit" class="general_style_input_button general_style_input_button_orange"><span>Search</span></a>
                    </div>
                </div>
            </div><!-- #search_wrapper -->
        </div><!-- #header_wrapper -->
        <div id="body_wrapper" class="wrapper">
            <div id="banner_wrapper" class="wrapper">
                <div id="banner_mask"></div>
                <div id="banner_container" class="container">
                    <p id="banner_title">Find a business</p>
                    <p id="banner_slogan">Find, share, promote and connect with top business in your area like never before</p>
                </div>
            </div><!-- #banner_wrapper -->
            <div id="action_button_wrapper" class="wrapper">
                <a href="listing/" id="action_button_sign_up" class="action_button"><span class="font_icon font_icon_tags general_style_colour_orange"></span><span class="text">View Popular Categories</span></a>
            </div><!-- #action_button_wrapper -->
            [[$body]]
        </div><!-- #body_wrapper -->
        <div id="footer_wrapper" class="wrapper">
        </div><!-- #footer_wrapper -->
    </div>
</div>
[[+script]]
</body>
</html>
