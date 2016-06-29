<?php
// Class Object
// Name: entity_place
// Description: Base class for all database table classes, read/write limited rows per query (PHP memory limit and system performance)

class entity_suburb extends entity_place
{
    function sync($parameter = array())
    {
        $sync_parameter = array();
        $sync_parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $sync_parameter['update_fields'] = array(
            'id' => $this->parameter['table'].'.id',
            'suburb' => $this->parameter['table'].'.name',
            'suburb_alt' => $this->parameter['table'].'.alternate_name',
            'area' => 'tbl_entity_place_area.name',
            'area_alt' => 'tbl_entity_place_area.alternate_name',
            'region' => 'tbl_entity_place_region.name',
            'region_alt' => 'tbl_entity_place_region.alternate_name',
            'state' => 'tbl_entity_place_state.name',
            'state_alt' => 'tbl_entity_place_state.alternate_name',
            'post' => $this->parameter['table'].'.post',
            'enter_time' => $this->parameter['table'].'.enter_time',
            'update_time' => $this->parameter['table'].'.update_time',
            'latitude' => $this->parameter['table'].'.latitude',
            'longitude' => $this->parameter['table'].'.longitude',
            'bounds_northeast_latitude' => $this->parameter['table'].'.bounds_northeast_latitude',
            'bounds_northeast_longitude' => $this->parameter['table'].'.bounds_northeast_longitude',
            'bounds_southwest_latitude' => $this->parameter['table'].'.bounds_southwest_latitude',
            'bounds_southwest_longitude' => $this->parameter['table'].'.bounds_southwest_longitude'
        );
        $sync_parameter['join'] = array(
            'LEFT JOIN tbl_entity_place_state ON '.$this->parameter['table'].'.state_id = tbl_entity_place_state.id',
            'LEFT JOIN tbl_entity_place_region ON '.$this->parameter['table'].'.region_id = tbl_entity_place_region.id',
            'LEFT JOIN tbl_entity_place_area ON '.$this->parameter['table'].'.area_id = tbl_entity_place_area.id'
        );
        $sync_parameter = array_merge($sync_parameter, $parameter);
        $result[] = parent::sync($sync_parameter);


        $sync_parameter = array();
        $sync_parameter['sync_table'] = str_replace('entity','view',$this->parameter['table']);
        $sync_parameter['update_fields'] = array(
            'id' => $this->parameter['table'].'.id',
            'friendly_url' => $this->parameter['table'].'.friendly_url',
            'suburb' => $this->parameter['table'].'.name',
            'state' => 'tbl_entity_place_state.alternate_name',
            'post' => $this->parameter['table'].'.post',
            'enter_time' => $this->parameter['table'].'.enter_time',
            'update_time' => $this->parameter['table'].'.update_time',
            'latitude' => $this->parameter['table'].'.latitude',
            'longitude' => $this->parameter['table'].'.longitude',
            'viewport_northeast_latitude' => $this->parameter['table'].'.viewport_northeast_latitude',
            'viewport_northeast_longitude' => $this->parameter['table'].'.viewport_northeast_longitude',
            'viewport_southwest_latitude' => $this->parameter['table'].'.viewport_southwest_latitude',
            'viewport_southwest_longitude' => $this->parameter['table'].'.viewport_southwest_longitude',
            'formatted_address' => $this->parameter['table'].'.formatted_address',
            'formatted_address_alt' => 'CONCAT('.$this->parameter['table'].'.name,", ",tbl_entity_place_state.alternate_name," ",'.$this->parameter['table'].'.postal_code)'
        );
        $sync_parameter['join'] = array(
            'JOIN tbl_entity_place_state ON '.$this->parameter['table'].'.state_id = tbl_entity_place_state.id'
        );
        $sync_parameter = array_merge($sync_parameter, $parameter);
        $result[] = parent::sync($sync_parameter);



        return $result;
    }
}

?>