<?php
    $app = (isset($_GET['script']))?$_GET['app']: $_POST['app'];
    include WPATH . 'bin' . DS . $app . DS . 'app.php';
    $methods = get_class_methods($app);
    
    $method = 'none';
    $result = array('select' => array(array('oText'=>'No View', 'oValue'=>$method)));
    foreach($methods as $method) {
        if(FALSE != strpos($method, '_view')) {
            $method = str_replace('_view', '', $method);
            $result['select'] []= array('oText'=>$method, 'oValue'=>$method);
        }
    }
    
    echo json_encode($result);
?>