<?php
// Class Object
// Name: entity_place
// Description: Base class for all database table classes, read/write limited rows per query (PHP memory limit and system performance)

class entity_place extends entity
{
    function sync($parameter = array())
    {
        $parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $parameter['update_fields'] = array(
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

        $parameter['join'] = array(
            'JOIN tbl_entity_place place_state ON tbl_entity_place.parent_id = place_state.id'
        );

        $parameter['where'] = array(
            'tbl_entity_place.type = "suburb"'
        );

        parent::sync($parameter);

        $parameter['sync_table'] = str_replace('entity','view',$this->parameter['table']);
        $parameter['update_fields'] = array(
            'id' => 'tbl_entity_place.id',
            'suburb' => 'tbl_entity_place.name',
            'suburb_alt' => 'tbl_entity_place.alternate_name',
            'state' => 'place_state.name',
            'state_alt' => 'place_state.alternate_name',
            'post' => 'tbl_entity_place.post',
            'enter_time' => 'tbl_entity_place.enter_time',
            'update_time' => 'tbl_entity_place.update_time',
            'latitude' => 'tbl_entity_place.latitude',
            'longitude' => 'tbl_entity_place.longitude'
        );

        $parameter['join'] = array(
            'JOIN tbl_entity_place place_state ON tbl_entity_place.parent_id = place_state.id'
        );

        $parameter['where'] = array(
            'tbl_entity_place.type = "suburb"'
        );

        parent::sync($parameter);
    }

}

?>