<!doctype html>
<html amp>
<head>
    <meta charset="utf-8">
    <title>[[*name]]</title>
    <link rel="canonical" href="[[*default_uri]]">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    [[+style]]
    [[+script]]
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
</head>
<body>
<div id="off_canvas_wrapper" class="wrapper">
    <div id="off_canvas_container" class="wrapper">
        <div id="off_canvas_container_mask" class="off_canvas_halt"></div>
        <div id="off_canvas_menu">
            <div class="off_canvas_menu_section">
                <div id="off_canvas_menu_section_nav_item_1" class="off_canvas_menu_item">
                    <a href="[[*base]]"><span>Home</span></a>
                </div>
                <div id="off_canvas_menu_section_business_item_1" class="off_canvas_menu_item">
                    <a href="[[*base]]listing/">Popular Categories</a>
                </div>
                <div id="off_canvas_menu_section_nav_item_2" class="off_canvas_menu_item">
                    <a href="[[*base]]about-us"><span>About Us</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_3" class="off_canvas_menu_item">
                    <a href="[[*base]]advertise-with-us"><span>Advertise with Us</span></a>
                </div>
            </div><!-- #off_canvas_menu_section_main_menu -->
            <div id="" class="off_canvas_menu_section">
                <div id="off_canvas_menu_section_nav_item_4" class="off_canvas_menu_item">
                    <a href="[[*base]]privacy-policy"><span>Privacy Policy</span></a>
                </div>
                <div id="off_canvas_menu_section_nav_item_5" class="off_canvas_menu_item">
                    <a href="[[*base]]terms-conditions"><span>Terms & Conditions</span></a>
                </div>
            </div>
            <div id="top_wrapper_off_canvas_trigger" class="off_canvas_trigger"></div>
        </div><!-- #off_canvas_menu -->
        <div id="header_wrapper" class="wrapper">
            <div id="top_wrapper" class="wrapper">
                <div id="top_wrapper_logo"><a href="[[*base]]" target="_blank"><amp-img width="80" height="40" src="[[*base]]/content/image/the-new-australian-social-business-directory_logo.svg"></amp-img></a></div>
            </div><!-- #top_wrapper -->
            <div id="search_wrapper" class="wrapper">
                <div id="search_container" class="container">
                    <div id="search_keyword_container" class="search_form_row">
                        <label for="search_keyword">What are you looking for?</label>
                        <input name="keyword" type="text" placeholder="What are you looking for?" id="search_keyword" class="general_style_input_text" value="[[&keyword]]">
                        <input name="category_id" type="hidden">
                    </div>
                    <div id="search_location_container" class="search_form_row">
                        <label for="search_location">In which Suburb?</label>
                        <input name="location" type="text" placeholder="In which Suburb?" id="search_location" class="general_style_input_text" value="[[&location]]">
                        <input name="location_id" type="hidden">
                        <input name="geo_location" type="hidden">
                    </div>
                    <div id="search_submit_container" class="search_form_row">
                        <a id="search_submit" class="general_style_input_button general_style_input_button_orange"><span>Search</span></a>
                    </div>
                </div>
                <div id="search_wrapper_close" class="search_halt"></div>
                <div id="top_wrapper_search_trigger" class="search_trigger"></div>
            </div><!-- #search_wrapper -->
        </div><!-- #header_wrapper -->
        <div id="body_wrapper" class="wrapper">
            [[$body]]
        </div><!-- #body_wrapper -->
        <div id="footer_wrapper" class="wrapper">
        </div><!-- #footer_wrapper -->
    </div>
</div>

</body>
</html>
