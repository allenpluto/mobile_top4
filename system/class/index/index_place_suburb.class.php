<?php
// Class Object
// Name: index_place_suburb
// Description: suburb index

class index_place_suburb extends index
{
    var $parameter = array(
        'primary_key' => 'id'
    );
    function __construct($value = Null, $parameter = array())
    {
        parent::__construct($value, $parameter);

        return $this;
    }

    protected function filter_by_word($value)
    {
        if ($this->_initialized AND empty($this->id_group)) return false;

        if (is_numeric($value))
        {
            $filter_parameter = array(
                'where' => 'post_code = :post_code',
                'bind_param' => array(':post_code'=>$value)
            );
        }
        else
        {
            $state_list = [
                'new south wales' => 'nsw',
                'victoria' => 'vic',
                'queensland' => 'qld',
                'australian capital territory' => 'act',
                'northern territory' => 'nt',
                'south australia' => 'sa',
                'western australia' => 'wa',
                'tasmania' => 'tas'
            ];
            if (isset($state_list[$value]))
            {
                // Text matches state long name, change it into state short name
                $value = $state_list[$value];
            }
            $filter_parameter = array(
                'where' => 'lower(suburb) = :location_text OR lower(region) = :location_text OR lower(state) = :location_text',
                'bind_param' => array(':location_text'=>$value)
            );
        }
        return parent::get($filter_parameter);
    }

    // Exact Match Search
    function filter_by_location_parameter($value, $parameter = array())
    {
        if (!is_array($value))
        {
            $value = explode('/',$value);
        }
        $filter_parameter = array('where'=>array(),'bind_param'=>array());
        foreach($value as $location_index=>$location_value)
        {
            switch($location_index)
            {
                case 'state':
                case 'region':
                case 'suburb':
                    $filter_parameter['where'][] = 'lower('.$location_index.') = :'.$location_index;
                    $filter_parameter['bind_param'][':'.$location_index] = $location_value;
                    break;
                default:
                    //$GLOBALS['global_message']->notice = __FILE__.'(line '.__LINE__.'): ['.get_class($this).'] illegal location value ['.$location_index.':'.$location_value.'] provided for '.__METHOD__;
            }
        }
        if (count($filter_parameter['where']) > 0)
        {
            return parent::get($filter_parameter);
        }
        else return false;

    }

    // Filter by suburb/region/state name, get id(s), Fuzzy Search
    function filter_by_location_text($value, $parameter = array())
    {
        if (empty($value)) return false;

        $parameter = array_merge([
            'where'=>'formatted_address = :formatted_address',
            'bind_param'=> [':formatted_address'=>$value]
        ],$parameter);

        $result = array();

        $this->get($parameter);
        if (count($this->id_group)>0)
        {
            $result['status'] = 'exact_match';
            $result['value'] = $this->id_group;
        }
        else
        {
            $this->reset();
            $filter_parameter = array(
                'value'=> $value,
                'fulltext_mode'=>'nature-language',
                'fulltext_index_key'=>'fulltext_location',
                'fulltext_min_score'=>0.5
            );
            $filter_parameter = array_merge($filter_parameter,$parameter);
            $result_score = $this->full_text_search($filter_parameter);

            if (count($this->id_group)>0)
            {
                $result['status'] = 'text_match';
                $result['value'] = $this->id_group;
                $result['score'] = $result_score;
            }
            else
            {
                $result['status'] = 'fail';
            }
        }
        return $result;
    }
}