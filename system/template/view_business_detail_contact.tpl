[[-view_business_detail_contact]]
<div id="listing_detail_view_contact_wrapper" class="wrapper listing_detail_view_section_wrapper">
    <div id="listing_detail_view_contact_container" class="container expand_parent expand_parent_expanded listing_detail_view_section_container">
        <div class="listing_detail_view_section_title expand_trigger">
            <h3>Contact</h3>
        </div>
        <div class="listing_detail_view_section_content_container expand_wrapper">
            <div class="listing_detail_view_section_content expand_container">
                <div id="listing_detail_view_phone_container" class="listing_detail_view_contact_row font_icon font_icon_phone">[[*phone]]</div>
                <div id="listing_detail_view_website_container" class="listing_detail_view_contact_row font_icon font_icon_ie">[[*website]]</div>
                <div id="listing_detail_view_address_container" class="listing_detail_view_contact_row font_icon font_icon_map"><p>[[*street_address]], <br>[[*suburb]]<br>[[*state]] [[*post]]</p><p class="general_style_colour_orange"><a href="javascript:void(0);">Click to View on Map</a></p></div>
                <div id="listing_detail_view_map_frame_container" class="listing_detail_view_contact_row">
                    <iframe id="listing_detail_view_map_frame" src="http://maps.google.com/maps?q=[[*geo_location_formatted]]&z=15&output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
