<?php
    $app = (isset($_GET['script']))?$_GET['app']: $_POST['app'];
    $val = (isset($_GET['script']))?$_GET['val']: (isset($_POST['val']))?$_POST['val']:NULL;
    include WPATH . 'bin' . DS . $app . DS . 'app.php';
    $methods = get_class_methods($app);
    
    $method = 'none';
    $result = array('select' => array(array('oText'=>'No Action', 'oValue'=>$method)));
    if(isset($val))
        $result['value'] = $val;
    
    foreach($methods as $method) {
        if(FALSE != strpos($method, '_action')) {
            $method = str_replace('_action', '', $method);
            $result['select'] []= array('oText'=>$method, 'oValue'=>$method);
        }
    }
    
    echo json_encode($result);
?>