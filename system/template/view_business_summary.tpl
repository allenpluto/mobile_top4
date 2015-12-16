[[-view_business_summary]]
<div id="listing_block_container_[[*id]]" class="block_container listing_block_container[[*extra_classes]]" itemscope="" itemtype="[[*schema_itemtype]]">
    <div class="block_thumb_container">
        [[$image]]
        [[$logo]]
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
            <div class="rating_star_wrapper" listing_id="[[*id]]">
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
    <div class="clear"></div>
    <div class="block_cover_over_link_container">
        <a href="[[&namespace]][[&path]][[*friendly_url]]" itemprop="url" title="[[*name]]" class="block_thumb_cover_over_link"></a>
    </div>
</div>