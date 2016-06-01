<?php
// Class Object
// Name: view_business_amp_detail_gallery_image
// Description: listing detail gallery image (AMP version)

class view_business_amp_detail_gallery_image extends view_gallery_image
{
    function fetch_value($parameter = array())
    {
        if (!isset($parameter['image_size'])) $parameter['image_size'] = 'm';
        $result = parent::fetch_value($parameter);
        if ($result !== false AND is_array($this->row))
        {
            foreach ($this->row as $row_index=>$row_value)
            {
                $this->row[$row_index]['image_src_m'] = URI_IMAGE . 'm/' . $row_value['image_file'];
                $this->row[$row_index]['image_src_l'] = URI_IMAGE . 'l/' . $row_value['image_file'];
                $this->row[$row_index]['image_src_xl'] = URI_IMAGE . 'xl/' . $row_value['image_file'];
                if (file_exists(PATH_IMAGE . $parameter['image_size'] . '/' . $row_value['image_file']))
                {
                    $info = getimagesize(PATH_IMAGE . $parameter['image_size'] . '/' . $row_value['image_file']);

                    $this->row[$row_index]['width'] = $info[0];
                    $this->row[$row_index]['height'] = $info[1];
                }
                else
                {
                    // try to generate image if not exists
                    $url = URI_IMAGE . $parameter['image_size'] . '/' . $row_value['image_file'];
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    $auth = curl_exec($curl);
                    curl_close($curl);

                    if ($auth)
                    {
                        if (file_exists(PATH_IMAGE . $parameter['image_size'] . '/' . $row_value['image_file']))
                        {
                            $info = getimagesize(PATH_IMAGE . $parameter['image_size'] . '/' . $row_value['image_file']);

                            $this->row[$row_index]['width'] = $info[0];
                            $this->row[$row_index]['height'] = $info[1];
                        }
                    }
                }
            }

            $result = $this->row;
        }
        return $result;
    }
}


?>