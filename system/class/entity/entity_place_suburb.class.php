<?php
// Class Object
// Name: entity_place_suburb
// Description: suburb entity table

class entity_place_suburb extends entity
{
    function sync($parameter = array())
    {
        $sync_parameter = array();
        $sync_parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $sync_parameter['update_fields'] = array(
            'id' => $this->parameter['table'].'.id',
            'suburb' => $this->parameter['table'].'.name',
            'suburb_alt' => $this->parameter['table'].'.alternate_name',
            'area_id' => 'tbl_entity_place_area.id',
            'area' => 'tbl_entity_place_area.name',
            'area_alt' => 'tbl_entity_place_area.alternate_name',
            'region_id' => 'tbl_entity_place_region.id',
            'region' => 'tbl_entity_place_region.name',
            'region_alt' => 'tbl_entity_place_region.alternate_name',
            'state_id' => 'tbl_entity_place_state.id',
            'state' => 'tbl_entity_place_state.name',
            'state_alt' => 'tbl_entity_place_state.alternate_name',
            'postal_code' => $this->parameter['table'].'.postal_code',
            'enter_time' => $this->parameter['table'].'.enter_time',
            'update_time' => $this->parameter['table'].'.update_time',
            'geometry_location_lat' => $this->parameter['table'].'.geometry_location_lat',
            'geometry_location_lng' => $this->parameter['table'].'.geometry_location_lng',
            'geometry_bounds_northeast_lat' => $this->parameter['table'].'.geometry_bounds_northeast_lat',
            'geometry_bounds_northeast_lng' => $this->parameter['table'].'.geometry_bounds_northeast_lng',
            'geometry_bounds_southwest_lat' => $this->parameter['table'].'.geometry_bounds_southwest_lat',
            'geometry_bounds_southwest_lng' => $this->parameter['table'].'.geometry_bounds_southwest_lng',
            'formatted_address' => $this->parameter['table'].'.formatted_address',
            'fulltext_location' => 'CONCAT('.$this->parameter['table'].'.name,", ",tbl_entity_place_state.alternate_name,", ",'.$this->parameter['table'].'.postal_code,", Australia")'
        );
        $sync_parameter['join'] = array(
            'LEFT JOIN tbl_entity_place_state ON '.$this->parameter['table'].'.state_id = tbl_entity_place_state.id',
            'LEFT JOIN tbl_entity_place_region ON '.$this->parameter['table'].'.region_id = tbl_entity_place_region.id',
            'LEFT JOIN tbl_entity_place_area ON '.$this->parameter['table'].'.area_id = tbl_entity_place_area.id'
        );
        $sync_parameter['fulltext_key'] = array(
            'fulltext_location' => ['fulltext_location']
        );
        $sync_parameter = array_merge($sync_parameter, $parameter);
        $result[] = parent::sync($sync_parameter);


        $sync_parameter = array();
        $sync_parameter['sync_table'] = str_replace('entity','view',$this->parameter['table']);
        $sync_parameter['update_fields'] = array(
            'id' => $this->parameter['table'].'.id',
            'friendly_url' => $this->parameter['table'].'.friendly_url',
            'suburb' => $this->parameter['table'].'.name',
            'area' => 'IF(tbl_entity_place_area.alternate_name=\'\',tbl_entity_place_area.name,tbl_entity_place_area.alternate_name)',
            'region' => 'IF(tbl_entity_place_region.alternate_name=\'\',tbl_entity_place_region.name,tbl_entity_place_region.alternate_name)',
            'state' => 'tbl_entity_place_state.alternate_name',
            'postal_code' => $this->parameter['table'].'.postal_code',
            'enter_time' => $this->parameter['table'].'.enter_time',
            'update_time' => $this->parameter['table'].'.update_time',
            'geometry_location_lat' => $this->parameter['table'].'.geometry_location_lat',
            'geometry_location_lng' => $this->parameter['table'].'.geometry_location_lng',
            'geometry_viewport_northeast_lat' => $this->parameter['table'].'.geometry_viewport_northeast_lat',
            'geometry_viewport_northeast_lng' => $this->parameter['table'].'.geometry_viewport_northeast_lng',
            'geometry_viewport_southwest_lat' => $this->parameter['table'].'.geometry_viewport_southwest_lat',
            'geometry_viewport_southwest_lng' => $this->parameter['table'].'.geometry_viewport_southwest_lng',
            'formatted_address' => $this->parameter['table'].'.formatted_address',
            'formatted_address_alt' => 'CONCAT('.$this->parameter['table'].'.name,", ",tbl_entity_place_state.alternate_name," ",'.$this->parameter['table'].'.postal_code)'
        );
        $sync_parameter['join'] = array(
            'LEFT JOIN tbl_entity_place_state ON '.$this->parameter['table'].'.state_id = tbl_entity_place_state.id',
            'LEFT JOIN tbl_entity_place_region ON '.$this->parameter['table'].'.region_id = tbl_entity_place_region.id',
            'LEFT JOIN tbl_entity_place_area ON '.$this->parameter['table'].'.area_id = tbl_entity_place_area.id'
        );
        $sync_parameter = array_merge($sync_parameter, $parameter);
        $result[] = parent::sync($sync_parameter);



        return $result;
    }
}

?>