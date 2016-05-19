<?php
// Class Object
// Name: entity_place
// Description: Base class for all database table classes, read/write limited rows per query (PHP memory limit and system performance)

class entity_place extends entity
{
    function sync($parameter = array())
    {
        $sync_parameter = array();
        $sync_parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $sync_parameter['update_fields'] = array(
            'id' => 'tbl_entity_place.id',
            'suburb' => 'tbl_entity_place.name',
            'suburb_alt' => 'tbl_entity_place.alternate_name',
            'state' => 'place_state.name',
            'state_alt' => 'place_state.alternate_name',
            'post' => 'tbl_entity_place.post',
            'enter_time' => 'tbl_entity_place.enter_time',
            'update_time' => 'tbl_entity_place.update_time',
            'latitude' => 'tbl_entity_place.latitude',
            'longitude' => 'tbl_entity_place.longitude',
            'bounds_northeast_latitude' => 'tbl_entity_place.bounds_northeast_latitude',
            'bounds_northeast_longitude' => 'tbl_entity_place.bounds_northeast_longitude',
            'bounds_southwest_latitude' => 'tbl_entity_place.bounds_southwest_latitude',
            'bounds_southwest_longitude' => 'tbl_entity_place.bounds_southwest_longitude'
        );
        $sync_parameter['join'] = array(
            'JOIN tbl_entity_place place_state ON tbl_entity_place.parent_id = place_state.id'
        );
        $sync_parameter['where'] = array(
            'tbl_entity_place.type = "suburb"'
        );
        $sync_parameter = array_merge($sync_parameter, $parameter);
        $result[] = parent::sync($sync_parameter);


        $sync_parameter = array();
        $sync_parameter['sync_table'] = str_replace('entity','view',$this->parameter['table']);
        $sync_parameter['update_fields'] = array(
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
        $sync_parameter['join'] = array(
            'JOIN tbl_entity_place place_state ON tbl_entity_place.parent_id = place_state.id'
        );
        $sync_parameter['where'] = array(
            'tbl_entity_place.type = "suburb"'
        );
        $sync_parameter = array_merge($sync_parameter, $parameter);
        $result[] = parent::sync($sync_parameter);



        return $result;
    }
}

?>