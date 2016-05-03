<?php
// Class Object
// Name: entity_organization
// Description: organization, business, company table, which stores all company (or organziaton) reltated information

class entity_organization extends entity
{
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
        //$parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $parameter['sync_table'] = 'tbl_index_organization_1';
        $parameter['update_fields'] = array(
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

        $parameter['join'] = array(
            'JOIN Listing_Category tbl_rel_category_to_listing ON tbl_entity_organization.id = tbl_rel_category_to_listing.listing_id',
            'LEFT JOIN ListingFeatured ON tbl_entity_organization.id = ListingFeatured.id',
            'LEFT JOIN tbl_entity_google_place ON tbl_entity_organization.id = tbl_entity_google_place.listing_id AND (tbl_entity_google_place.types = "route" OR tbl_entity_google_place.types = "street_address" OR tbl_entity_google_place.types = "subpremise")'
        );

        $parameter['where'] = array(
            'tbl_entity_organization.status = "A"'
        );

        $parameter['group'] = array(
            'tbl_entity_organization.id'
        );

        $parameter['fulltext_key'] = array(
            'fulltext_keywords' => ['name','alternate_name','description','keywords']
        );

        if ($parameter['full_sync'] = true)
        {
            parent::full_sync($parameter);
        }
        else
        {
            parent::sync($parameter);
        }


        /*$parameter['sync_table'] = str_replace('entity','view',$this->parameter['table']);
        $parameter['update_fields'] = array(
            'id' => 'tbl_entity_place.id',
            'friendly_url' => 'tbl_entity_place.friendly_url',
            'suburb' => 'tbl_entity_place.alternate_name',
            'state' => 'place_state.alternate_name',
            'post' => 'tbl_entity_place.post',
            'enter_time' => 'tbl_entity_place.enter_time',
            'update_time' => 'tbl_entity_place.update_time',
            'latitude' => 'tbl_entity_place.latitude',
            'longitude' => 'tbl_entity_place.longitude',
            'viewport_northeast_latitude' => 'tbl_entity_place.viewport_northeast_latitude',
            'viewport_northeast_longitude' => 'tbl_entity_place.viewport_northeast_longitude',
            'viewport_southwest_latitude' => 'tbl_entity_place.viewport_southwest_latitude',
            'viewport_southwest_longitude' => 'tbl_entity_place.viewport_southwest_longitude',
            'formatted_address' => 'tbl_entity_place.formatted_address',
            'formatted_address_alt' => 'CONCAT(tbl_entity_place.alternate_name,", ",place_state.alternate_name," ",tbl_entity_place.post)'
        );

        $parameter['join'] = array(
            'JOIN tbl_entity_place place_state ON tbl_entity_place.parent_id = place_state.id'
        );

        $parameter['where'] = array(
            'tbl_entity_place.type = "suburb"'
        );

        parent::sync($parameter);*/
    }
}

?>