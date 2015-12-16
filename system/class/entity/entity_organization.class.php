<?php
// Class Object
// Name: entity_organization
// Description: organization, business, company table, which stores all company (or organziaton) reltated information

class entity_organization extends entity_thing
{
    // class organziaton is allowed to be constructed by 'friendly_url' or 'id'. However, if both provided, 'id' overwrite 'friendly_url'. e.g. $organization_obj = new organization('example-friendly-url-345')
    // use other functions to select a group of people
    function __construct($init_value = Null, $parameter = array())
    {    
        parent::__construct();
        if (!empty($parameter))
        {
            $this->set_parameter($parameter);
        }
        if (!is_null($init_value))
        {
            if (is_array($init_value))
            {
                $this->row = $init_value;
                $this->get();
            }
            else    // Simplified usage, not secured
            {
                if (is_numeric($parameter)) // try to initialize with id
                {
                    $this->get(array('id'=>$parameter));
                }
                else // try to initialize with friendly url
                {
                    $this->get(array('friendly_url'=>$parameter));
                }
            }
        }

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
                    case 'order_by':
                        $get_parameter['order_by'] = $parameter_value;
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
        parent::get($get_parameter);

        // Additional data format change code here
    }

    function set($parameter = array())
    {
        // Call thing::set function
        parent::set($parameter);
    }
}

?>