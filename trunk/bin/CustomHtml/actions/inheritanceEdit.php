<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $pgYaml = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml");
            if(isset($_POST[$APP_ID . '_save']) && 'Save' == $_POST[$APP_ID . '_save']) {
                $starts = explode(',', $_POST[$APP_ID . '_start']);
                foreach($starts as &$start) { $start = trim($start) . ".yaml"; }
                $ends = explode(',', $_POST[$APP_ID . '_end']);
                foreach($ends as &$end) { $end = trim($end) . ".yaml"; }
                $pgYaml['inherit']['start'] = $starts;
                $pgYaml['inherit']['end'] = $ends;
                file_write(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", Spyc::YAMLDump($pgYaml));
                $this->info = "Page Saved!";
            }
?>