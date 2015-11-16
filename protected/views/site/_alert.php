<?php
$this->widget('booster.widgets.TbAlert', array(
    'id' => 'alert',
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(
        'warning' => array('closeText' => '&times;'),
        'success' => array('closeText' => '&times;'),
        'error' => array('closeText' => '&times;'),
    ),
));
?>