<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/06/2016
 * Time: 1:45 PM
 */

include('../system/config/config.php');
$timestamp = microtime(true);
echo '<pre>';

$entity_organization = new entity_organization();
$entity_organization->sync();
?>
<div class="system_debug"><div class="container">
<?php
print_r($global_message->display());
print_r('Executing time: '.(microtime(true) - $timestamp).' seconds <br>');
?>
</div></div>