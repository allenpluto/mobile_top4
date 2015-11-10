[[~view_business_detail]]
<div id="listing_detail_view_wrapper" class="wrapper[[*extra_classes]]" itemscope="" itemtype="[[*schema_itemtype]]">
    <div id="listing_detail_view_top_wrapper" class="wrapper" style="background-image: url([[*banner_src]]);">
        <div id="listing_detail_view_top_container" class="container">
            <div class="listing_detail_view_top_logo_container">
                <img itemprop="image" src="[[*logo_image_src]]">
            </div>
            <div class="listing_detail_view_top_text_container">
                <div class="listing_detail_view_title_container"><h1>[[*name]]</h1></div>
                <div class="block_content_rating_container">
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
            </div>
        </div>

    </div>
</div>
<div id="listing_block_container_[[*id]]" class="block_container listing_block_container[[*extra_classes]]" itemscope="" itemtype="[[*schema_itemtype]]">
    <div class="block_thumb_container">
        <div class="block_thumb_image_container" style="background-image: url([[*image_src]]);"></div>
        <div class="block_thumb_logo_container">
            <img itemprop="image" src="[[*logo_image_src]]">
        </div>
        <div class="clear"></div>
    </div>
    <div class="block_content_container">
        <div class="block_content_text_container">
            <h3 class="block_content_title" itemprop="name" title="[[*name]]">[[*name]]</h3>
            <p class="block_content_description" itemprop="description">
                [[*description]]
            </p>
            <p class="block_content_address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                <span itemprop="streetAddress">[[*street_address]]</span>,
                <span itemprop="addressLocality">[[*suburb]]</span> <span itemprop="addressRegion">[[*state]]</span>
                <span itemprop="postalCode">[[*post]]</span>
            </p>
        </div>
        <div class="block_content_rating_container">
            <div class="block_content_rating_star_wrapper">
                <div class="block_content_rating_star_container block_content_rating_star_bg_container"><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
			 --></div>
                <div class="block_content_rating_star_container block_content_rating_star_front_container" style="width: [[*avg_review_percentage]]%;"><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
			 --></div>
            </div>
            <div class="block_content_rating_description" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="[[*avg_review]]">
                <meta itemprop="reviewCount" content="[[*count_review]]">
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="block_cover_over_link_container">
        <a href="[[*friendly_url]]" itemprop="url" title="[[*name]]" class="block_thumb_cover_over_link"></a>
    </div>
</div>