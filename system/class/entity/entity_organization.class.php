<?php
// Class Object
// Name: entity_organization
// Description: organization, business, company table, which stores all company (or organziaton) reltated information

class entity_organization extends entity
{
    function __construct($value = Null, $parameter = array())
    {
        $default_parameter = [
            'relational_fields'=>[
                'category'=>[],
                'gallery'=>[]
            ]
        ];
        $parameter = array_merge($default_parameter, $parameter);
        parent::__construct($value, $parameter);

        return $this;
    }

    function get($parameter = array())
    {
        $get_parameter = array('bind_param'=>array());

        if (is_array($parameter)) $parameter = array_merge($this->parameter, $parameter);
        else $parameter = $this->parameter;

        if (!empty($parameter))
        {
            foreach ($parameter as $parameter_index => $parameter_value)
            {
                switch ($parameter_index)
                {
                    case 'friendly_url':
                        $get_parameter['where'][] = '`friendly_url` = :friendly_url';
                        $get_parameter['bind_param'][':friendly_url'] = $parameter_value;
                        break;
                    case 'id':
                        $get_parameter['where'][] = '`id` = :id';
                        $get_parameter['bind_param'][':id'] = $parameter_value;
                        break;
                    case 'order':
                        $get_parameter['order'] = $parameter_value;
                        break;
                    case 'limit':
                        $get_parameter['limit'] = ':limit';
                        $get_parameter['bind_param'][':limit'] = $parameter_value;
                        break;
                    case 'offset':
                        $get_parameter['offset'] = ':offset';
                        $get_parameter['bind_param'][':offset'] = $parameter_value;
                        break;
                    default:
                        break;
                }
            }
        }

        // Call thing::get function
        return parent::get($get_parameter);
    }

    function sync($parameter = array())
    {
        $sync_parameter = array();

        // set default sync parameters for index table
        //$parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $sync_parameter['sync_table'] = 'tbl_index_organization_1';
        $sync_parameter['update_fields'] = array(
            'id' => 'tbl_entity_organization.id',
            'name' => 'tbl_entity_organization.name',
            'alternate_name' => 'tbl_entity_organization.alternate_name',
            'description' => 'tbl_entity_organization.description',
            'enter_time' => 'tbl_entity_organization.enter_time',
            'update_time' => 'tbl_entity_organization.update_time',
            'keywords' => 'tbl_entity_organization.keywords',
            'latitude' => 'tbl_entity_google_place.geometry_location_lat',
            'longitude' => 'tbl_entity_google_place.geometry_location_lng',
            'abn' => 'tbl_entity_organization.abn',
            'account_id' => 'tbl_entity_organization.account_id',
            'place_id' => 'tbl_entity_google_place.id',
            'category_id' => 'GROUP_CONCAT(tbl_rel_category_to_listing.category_id)',
            'featured' => 'IF((CURDATE()<=ListingFeatured.date_end AND CURDATE()>=ListingFeatured.date_start), 1, 0)'
        );

        $sync_parameter['join'] = array(
            'JOIN Listing_Category tbl_rel_category_to_listing ON tbl_entity_organization.id = tbl_rel_category_to_listing.listing_id',
            'LEFT JOIN ListingFeatured ON tbl_entity_organization.id = ListingFeatured.id',
            'LEFT JOIN tbl_entity_google_place ON tbl_entity_organization.id = tbl_entity_google_place.listing_id AND (tbl_entity_google_place.types = "route" OR tbl_entity_google_place.types = "street_address" OR tbl_entity_google_place.types = "subpremise")'
        );

        $sync_parameter['where'] = array(
            'tbl_entity_organization.status = "A"'
        );

        $sync_parameter['group'] = array(
            'tbl_entity_organization.id'
        );

        $sync_parameter['fulltext_key'] = array(
            'fulltext_keywords' => ['name','alternate_name','description','keywords']
        );

        $sync_parameter = array_merge($sync_parameter, $parameter);

        $result[] = parent::sync($sync_parameter);


        $sync_parameter = array();

        // set default sync parameters for view table
        $sync_parameter['sync_table'] = 'tbl_view_organization_1';
        $sync_parameter['update_fields'] = array(
            'id' => 'tbl_entity_organization.id',
            'friendly_url' => 'tbl_entity_organization.friendly_url',
            'name' => 'tbl_entity_organization.name',
            'alternate_name' => 'tbl_entity_organization.alternate_name',
            'description' => 'tbl_entity_organization.description',
            'enter_time' => 'tbl_entity_organization.enter_time',
            'update_time' => 'tbl_entity_organization.update_time',
            'keywords' => 'tbl_entity_organization.keywords',
            'latitude' => 'tbl_entity_google_place.geometry_location_lat',
            'longitude' => 'tbl_entity_google_place.geometry_location_lng',
            'abn' => 'tbl_entity_organization.abn',
            'account_id' => 'tbl_entity_organization.account_id',
            'logo_id' => 'logo_image.id',
            'logo_src' => 'CONCAT("'.URI_IMAGE_EXTERNAL.'", logo_image.prefix, "photo_", logo_image.id, ".", LCASE(logo_image.type))',
            'banner_id' => 'banner_image.id',
            'banner_src' => 'CONCAT("'.URI_IMAGE_EXTERNAL.'", banner_image.prefix, "photo_", banner_image.id, ".", LCASE(banner_image.type))',
            'content' => 'tbl_entity_organization.content',
            'address_additional_info' => 'tbl_entity_organization.address_additional_info',
            'street_address' => 'CONCAT(tbl_entity_google_place.street_number," ",tbl_entity_google_place.route_short)',
            'suburb' => 'tbl_entity_google_place.locality_short',
            'state' => 'tbl_entity_google_place.administrative_area_level_1_short',
            'post' => 'tbl_entity_google_place.postal_code',
            'place_id' => 'tbl_entity_google_place.id',
            'category_id' => 'GROUP_CONCAT(tbl_rel_category_to_listing.category_id)',
            'featured' => 'IF((CURDATE()<=ListingFeatured.date_end AND CURDATE()>=ListingFeatured.date_start), 1, 0)'
        );

        $sync_parameter['join'] = array(
            'LEFT JOIN Listing_Category tbl_rel_category_to_listing ON tbl_entity_organization.id = tbl_rel_category_to_listing.listing_id',
            'LEFT JOIN Image logo_image ON tbl_entity_organization.logo_id = logo_image.id',
            'LEFT JOIN Image banner_image ON tbl_entity_organization.banner_id = banner_image.id',
            'LEFT JOIN ListingFeatured ON tbl_entity_organization.id = ListingFeatured.id',
            'LEFT JOIN tbl_entity_google_place ON tbl_entity_organization.id = tbl_entity_google_place.listing_id AND (tbl_entity_google_place.types = "route" OR tbl_entity_google_place.types = "street_address" OR tbl_entity_google_place.types = "subpremise")'
        );

        $sync_parameter['where'] = array(
            'tbl_entity_organization.status = "A"'
        );

        $sync_parameter['group'] = array(
            'tbl_entity_organization.id'
        );

        $sync_parameter['fulltext_key'] = array();

        $sync_parameter = array_merge($sync_parameter, $parameter);

        $result[] = parent::sync($sync_parameter);
    }
}

?>