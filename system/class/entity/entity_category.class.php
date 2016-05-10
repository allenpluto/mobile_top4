<?php
// Class Object
// Name: entity_category
// Description: (business) category, mainly follow the standard of schema.org

class entity_category extends entity
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
        $sync_parameter = array();

        // set default sync parameters for index table
        //$parameter['sync_table'] = str_replace('entity','index',$this->parameter['table']);
        $sync_parameter['sync_table'] = 'tbl_index_category';
        $sync_parameter['update_fields'] = array(
            'id' => 'tbl_entity_category.id',
            'name' => 'tbl_entity_category.name',
            'alternate_name' => 'tbl_entity_category.alternate_name',
            'description' => 'tbl_entity_category.description',
            'enter_time' => 'tbl_entity_category.enter_time',
            'update_time' => 'tbl_entity_category.update_time',
            'keywords' => 'tbl_entity_category.keywords',
            'category_id' => 'tbl_entity_category.category_id',
            'organization_count' => 'join_category_organization.organization_count'
        );

        if (!isset($parameter['sync_type']))
        {
            $parameter['sync_type'] = 'differential_sync';
        }

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
        if ($db->db_table_exists($sync_parameter['sync_table'])) $parameter['sync_type'] = 'full_sync';

        $category_id_condition = '';
        switch ($parameter['sync_type'])
        {
            case 'update_current':
            case 'delete_current':
            case 'differential_sync':
                if (count($this->id_group) > 0)
                {
                    $category_id_condition = ' WHERE category_id IN ('.implode(',',$this->id_group).')';
                }
                break;
            case 'full_sync':
            default:
        }

        $sync_parameter['join'] = array(
            'JOIN (SELECT category_id, COUNT(*) AS organization_count FROM tbl_rel_category_to_organization'.$category_id_condition.' GROUP BY category_id) join_category_organization ON join_category_organization.category_id = tbl_entity_category.id'
        );

        $sync_parameter['where'] = array(
            'tbl_entity_category.status = "A"'
        );

        $sync_parameter['fulltext_key'] = array(
            'fulltext_keywords' => ['name','alternate_name','description','keywords']
        );

        $sync_parameter = array_merge($sync_parameter, $parameter);

        $result[] = parent::sync($sync_parameter);


        $sync_parameter = array();

        // set default sync parameters for view table
        $sync_parameter['sync_table'] = 'tbl_view_category';
        $sync_parameter['update_fields'] = array(
            'id' => 'tbl_entity_category.id',
            'friendly_url' => 'tbl_entity_category.friendly_url',
            'name' => 'tbl_entity_category.name',
            'alternate_name' => 'tbl_entity_category.alternate_name',
            'description' => 'tbl_entity_category.description',
            'enter_time' => 'tbl_entity_category.enter_time',
            'update_time' => 'tbl_entity_category.update_time',
            'keywords' => 'tbl_entity_category.keywords',
            'category_id' => 'tbl_entity_category.category_id',
            'organization_count' => 'join_category_organization.organization_count'
            //'image_id' => 'join_image.id_concat',
            //'image_src' => 'join_image.src_concat'
        );


        if (!isset($parameter['sync_type']))
        {
            $parameter['sync_type'] = 'differential_sync';
        }

        if ($GLOBALS['db']) $db = $GLOBALS['db'];
        else $db = new db;
        if ($db->db_table_exists($sync_parameter['sync_table'])) $parameter['sync_type'] = 'full_sync';

        $category_id_condition = '';
        switch ($parameter['sync_type'])
        {
            case 'update_current':
            case 'delete_current':
            case 'differential_sync':
                if (count($this->id_group) > 0)
                {
                    $category_id_condition = ' WHERE category_id IN ('.implode(',',$this->id_group).')';
                }
                break;
            case 'full_sync':
            default:
        }

        $sync_parameter['join'] = array(
            'JOIN (SELECT category_id, COUNT(*) AS organization_count FROM tbl_rel_category_to_organization'.$category_id_condition.' GROUP BY category_id) join_category_organization ON join_category_organization.category_id = tbl_entity_category.id'
        );

        $sync_parameter['where'] = array(
            'tbl_entity_category.status = "A"'
        );

        $sync_parameter['group'] = array(
            'tbl_entity_category.id'
        );

        $sync_parameter['fulltext_key'] = array();

        $sync_parameter = array_merge($sync_parameter, $parameter);

        $result[] = parent::sync($sync_parameter);
    }
}

?>