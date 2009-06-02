<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Region {
    
        // prints a page recursively using InheritLoad Function
        public static function Load($regionName) {
            global $_APPS;
            Region::InheritLoad(WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml(), $regionName);
        }
        
        private static function InheritLoad($fileName, $regionName) {
            global $_APPS;
            
            $pageYaml = yaml_load($fileName);
            // Find pages included under start inheritance section
            if(is_array($pageYaml['inherit']['start'])) { // Load the pages inherited in start section
                foreach($pageYaml['inherit']['start'] as $pgYaml) {
                    if($pgYaml != 'none' && $pgYaml != '')  { 
                        if ( defined('ADMIN_MODE') )
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . 'admin' . DS . $pgYaml;
                        else
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                        Region::InheritLoad($pgYaml, $regionName); // Recursive call. Beware of infinite recursion!
                    }
                }
            }
            
            if ( isset($pageYaml['regions'][$regionName]) && is_array($pageYaml['regions'][$regionName]) )
                $region = $pageYaml['regions'][$regionName];
            else
                $region = array();
            foreach($region as $appId => $app) {
                if ( isset( $_APPS[$appId] ) ) {
                    if (isset($app['ajaxify']) && 'yes' == $app['ajaxify']) {
                        echo "<div id=\"ajaxed_$appId\">\n";
                    }
                    echo $_APPS[$appId]; // echo each app. HTML is automatically generated
                    if (isset($app['ajaxify']) && 'yes' == $app['ajaxify']) {
                        echo "</div>\n";
                        echo "<script type=\"text/javascript\">\n";
                        echo "$('form', $('#ajaxed_$appId')).submit ( function(e) {\n";
                        echo "  e.preventDefault();\n";
                        echo "  var data = $('input, textarea, select', $(this)).serialize();\n";
                        echo "  $('#ajaxed_$appId').append('Working...');\n";
                        echo "  $.post($(this).attr('action')+'?appId=$appId', data, function(ret) {\n";
                        echo "    $('#ajaxed_$appId').html(ret);\n";
                        if(isset($app['ajaxReload'])) {
                            $reloadDivs = explode(',', $app['ajaxReload']);
                            foreach($reloadDivs as $div) {
                                echo "    $.get('$_SERVER[PHP_SELF]?appId=$div', null, function(ret) {\n";
                                echo "      $('#ajaxed_$div').html(ret);\n";
                                echo "    });\n";
                            }
                        }
                        echo "    });\n";
                        echo "});\n";
                        echo "</script>\n";
                    }
                }
            }
            
            // Find pages included under end inheritance section
            if(is_array($pageYaml['inherit']['end'])) { // Load the pages inherited in start section
                foreach($pageYaml['inherit']['end'] as $pgYaml) {
                    if($pgYaml != 'none' && $pgYaml != '')  { 
                        if ( defined('ADMIN_MODE') )
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . 'admin' . DS . $pgYaml;
                        else
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                        Region::InheritLoad($pgYaml, $regionName); // Recursive call. Beware of infinite recursion!
                    }
                }
            }
        }
    }
    

?>
