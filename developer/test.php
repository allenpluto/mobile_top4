<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/11/2015
 * Time: 2:00 PM
 */
include('../system/config/config.php');

echo '<pre>';

/*$id_array = array(3, 4, 5, 'a', 'b', 'c', ' 231', '%333');

$format_function = format::get_obj();
$instance = $format_function->id_group($id_array);
print_r($instance);*/

/*$listing_id = array(1,4,8,11,22);
for($i=70220;$i<70237;$i++)
{
    $listing_id[] = $i;
}
shuffle($listing_id);
print_r($listing_id);
$category_id = 88;
$index_organization = new index_organization($listing_id);
print_r($index_organization->id_group);
$index_organization->filter_by_category($category_id);
print_r($index_organization->id_group);*/

/*$listing_id = array();
$index_organization = new index_organization($listing_id);
$index_postcode = new index_postcode();
$index_postcode->filter_by_location_text('castle hill, nsw');
print_r($index_postcode);

print_r($index_organization->filter_by_suburb($index_postcode->id_group));

$view_business_summary_obj = new view_business_summary($index_organization->id_group,array('page_size'=>4,'order'=>'RAND()'));
print_r($view_business_summary_obj);*/

/*$listing_id = array();
$index_organization = new index_organization($listing_id);
$keyword_score = $index_organization->filter_by_keyword($_GET['keyword']);
print_r($keyword_score);
$location_score = $index_organization->filter_by_location($_GET['location'],array('preset_score'=>$keyword_score));
print_r($location_score);
$final_score = array();
//$index_organization->reset();
//print_r($index_organization->filter_by_keywords2($_GET['keyword']));
print_r($index_organization->id_group);
$view_business_summary = new view_business_summary($index_organization->id_group);
print_r($view_business_summary->fetch_value());*/


/*$index_organization = new index_organization();
print_r($index_organization);*/

/*$index_category = new index_category();
print_r($index_category->filter_by_listing_count());
print_r($index_category->filter_by_listing(array(10596,65667)));*/

/*$index_image_obj = new index_image();
print_r($index_image_obj->get_gallery_images(12026));
print_r($index_image_obj);
$view_image_obj = new view_image($index_image_obj->id_group);
print_r($view_image_obj->render());
$index_image_obj->reset();

print_r($index_image_obj->get_gallery_images(88,array('item_type'=>'listingcategory')));
print_r($index_image_obj);
$view_image_obj = new view_image($index_image_obj->id_group);
print_r($view_image_obj->render());*/


/*$index_category_obj = new index_category();
$index_category_obj->filter_by_active();
$index_category_obj->filter_by_listing_count();
$view_category_obj = new view_category($index_category_obj->id_group);
echo '<pre>';
print_r($index_category_obj->id_group);
print_r($view_category_obj);
exit();
$render_parameter = array(
    'template'=>PREFIX_TEMPLATE_PAGE.'master',
    'build_from_content'=>array(
        array(
            'title'=>'Find Top4 Businesses in Australia',
            'meta_description'=>'Find Top4 Businesses in Australia',
            'body'=>$view_category_obj
        )
    )
);
$view_web_page_obj = new view_web_page(null,$render_parameter);*/

/*$index_postcode_obj = new index_location();
$index_postcode_obj->filter_by_parameter('nsw/sydney')*/


//$format = format::get_obj();
//$uri_parameters = $format->uri_decoder('listing/find/plumber/nsw/sydney-region');

//$index_location_obj = new index_location();
//$index_location_obj->filter_by_location_parameter($uri_parameters);
//print_r(count($index_location_obj->id_group));
//print_r($global_message);

/*print_r(parse_url('/listing/find/restaurant/?nocache=true'));
echo '<br>';
print_r(parse_url('/listing/find/restaurant/?nocache=true',PHP_URL_PATH));
echo '<br>';
$query_string = parse_url('/listing/find/restaurant/?nocache=true&test1=test+1&test2=&test3=Hello World',PHP_URL_QUERY);
print_r($query_string);
echo '<br>';
parse_str($query_string, $result);
print_r($result);

$view_business_detail_gallery_obj = new view_business_detail_gallery();
$view_business_detail_gallery_obj->get_business_gallery([12026]);
print_r($view_business_detail_gallery_obj);
$view_business_detail_gallery_image_obj = new view_business_detail_gallery_image();
$view_business_detail_gallery_image_obj->get_by_gallery([1690]);
print_r($view_business_detail_gallery_image_obj);
print_r($GLOBALS['global_message']);*/

$entity = new entity_organization();
//$param = ['table_fields'=>['friendly_url','name']];
//$value = [['test1','Test Name 1'],['test2','Test Name 2']];
//print_r($entity->set($value,$param));

$param = ['table_fields'=>['friendly_url','name','address','suburb_id','email','telephone']];
/*$value = [
    [6,'list_6','Test List 6'],
    [11,'list_11','Test List 11'],
    [23,'list_23','Test List 23'],
    ['','list_26','Test List 26'],
    ['friendly_url'=>'new_list_8','name'=>'Test List 8','id'=>8],
    ['name'=>'New List 24','id'=>24],
    ['friendly_url'=>'new-test-url']
];*/
$value = [['test-lisitng-1', 'Test Insert New Listing','19 bond street', 721, 'test@top4.com.au', '02 9639 2711']];
print_r($entity->set($value,$param));
$entity->get(['where'=>'`friendly_url` LIKE :friendly_url','bind_param'=>[':friendly_url'=>'list_%']]);
print_r($entity->id_group);
print_r($entity->update(['friendly_url'=>'listing_test']));
print_r($global_message);