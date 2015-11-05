<?php
    // Template for view_business_summary
?>
<div id="listing_block_container_[[*id]]" class="block_container listing_block_container[[*extra_classes]]" itemscope="" itemtype="[[*schema_itemtype]]">
    <div class="block_thumb_container">
        <div class="block_thumb_image_container">
            <img src="[[*image_src]]" itemprop="image" alt="[[*name]]">
        </div>

        <div class="block_thumb_overlay_container">
            <div class="block_thumb_overlay">
                <div class="block_thumb_overlay_description">
                    <h3>[[*name]]</h3>
                    <p>[[*description]]</p>
                </div>
            </div>
        </div>
        <div class="block_thumb_cover_over_link_container">
            <a href="[[*friendly_url]]" itemprop="url" title="[[*name]]" class="block_thumb_cover_over_link"></a>
        </div>
        <div class="block_thumb_logo_container">
            <a href="[[*friendly_url]]">
                <img src="[[*logo_image_src]]">
            </a>
        </div>
    </div>
    <div class="block_content_container">
        <div class="block_content_rating_container">
            <div class="block_content_rating_star_wrapper" listing_id="[[*id]]">
                <div class="block_content_rating_star_container block_content_rating_star_bg_container"><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
			 --></div>
                <div class="block_content_rating_star_container block_content_rating_star_front_container" style="width: [[*avg_review_percentage]]"><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
				 --><span class="block_content_rating_star"></span><!--
			 --></div>
            </div>
            <div class="block_content_rating_description">
                <p itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating"><span itemprop="ratingValue">[[*avg_review]]</span> stars by <span itemprop="reviewCount">[[*count_review]]</span> ratings</p>
            </div>
        </div>
        <div class="clear"><!-- --></div>
        <div class="block_content_description_container">
            <h3 class="block_content_description_title"><a href="[[*friendly_url]]" title="[[*name]]">[[*name]]</a></h3>
            <p class="block_content_description_address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                <span itemprop="streetAddress">[[*street_address]]</span>,
                <span itemprop="addressLocality">[[*suburb]]</span> <span itemprop="addressRegion">[[*state]]</span>
                <span itemprop="postalCode">[[*post]]</span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="block_more_details_button_container">
        <a href="[[*friendly_url]]" title="[[*name]]"><span class="block_more_details_button_text">More Details</span> <span class="block_more_details_button_icon block_more_details_button_icon_next"></span></a>
    </div>
</div>