[[-view_business_detail]]
<div id="listing_detail_view_wrapper" class="wrapper[[*extra_classes]]" itemscope="" itemtype="[[*schema_itemtype]]">
    <div id="listing_detail_view_top_wrapper" class="wrapper">
        <div id="listing_detail_view_top_container" class="container column_container">
            [[$logo]]
            <div class="listing_detail_view_top_text_container[[*top_text_container_column]]">
                <div class="listing_detail_view_title_container"><h1>[[*name]]</h1></div>
                <div class="listing_detail_view_rating_container">
                    <div class="listing_detail_view_count_visit"><span>[[*count_visit]]</span><span class="listing_detail_view_count_visit_label"> Visits</span></div>
                    <div class="rating_star_wrapper">
                        <div class="rating_star_container rating_star_bg_container"><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                            --></div>
                        <div class="rating_star_container rating_star_front_container" style="width: [[*avg_review_percentage]]%;"><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                                --><span class="rating_star"></span><!--
                            --></div>
                    </div>
                    <div class="block_content_rating_description" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                        <meta itemprop="ratingValue" content="[[*avg_review]]">
                        <meta itemprop="reviewCount" content="[[*count_review]]">
                    </div>
                </div>
                <div id="listing_detail_view_address_container_large_screen" class="listing_detail_view_address_container">
                    <p itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                        <span itemprop="streetAddress">[[*street_address]]</span>,
                        <span itemprop="addressLocality">[[*suburb]]</span> <span itemprop="addressRegion">[[*state]]</span>
                        <span itemprop="postalCode">[[*post]]</span>
                    </p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="listing_detail_view_summary_wrapper" class="wrapper listing_detail_view_section_wrapper">
        <div class="wrapper listing_detail_view_section_title_wrapper">
            <div class="container listing_detail_view_section_title_container"><h2>[[*category_name]] in [[*suburb]], [[*state]] [[*post]]</h2></div>
        </div>
        <div class="wrapper listing_detail_view_section_content_wrapper">
            <div class="container listing_detail_view_section_content_container">
                <p class="listing_detail_view_summary" itemprop="description">
                    [[*description]]
                </p>
            </div>
        </div>
    </div>
    [[$keyword_section]]
    [[$overview_section]]
    [[$contact_section]]
    [[$map_section]]
</div>