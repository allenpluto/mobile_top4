<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/02/2016
 * Time: 11:57 AM
 */

$test_text = '{"id_group":{":id_0":10828,":id_1":10833,":id_2":10836,":id_3":10852,":id_4":10876,":id_5":64941,":id_6":64989,":id_7":65100,":id_8":65834,":id_9":72023,":id_10":72312,":id_11":79967,":id_12":80300,":id_13":81011,":id_14":85481},"page_size":8,"page_number":0,"page_count":2}';
echo base64_encode($test_text);
echo '<br>';
?>
<script>
    document.write(btoa('<?=$test_text?>'));
    var json_obj = eval(atob('<?=base64_encode($test_text)?>'));
    console.log(typeof json_obj);
</script>