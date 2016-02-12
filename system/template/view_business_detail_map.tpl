[[-view_business_detail_map]]
<div id="listing_detail_view_map_wrapper" class="wrapper listing_detail_view_section_wrapper">
    <div id="listing_detail_view_map_container" class="container expand_parent expand_parent_expanded listing_detail_view_section_container">
        <div class="listing_detail_view_section_title expand_trigger">
            <h3>Map</h3>
        </div>
        <div class="listing_detail_view_section_content_container expand_wrapper">
            <div class="listing_detail_view_section_content expand_container">
                <div id="listing_detail_view_map_address">
                    [[*street_address]], [[*suburb]] [[*state]] [[*post]]
                </div>
                <div id="listing_detail_view_map_frame_container"><iframe id="listing_detail_view_map_frame" src="http://maps.google.com/maps?q=[[*geo_location_formatted]]&z=15&output=embed"></iframe></div>
            </div>
        </div>
    </div>
</div>
