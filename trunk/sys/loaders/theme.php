<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Theme {
        // Loads the Template generator for current Theme
        public static function PreLoad() {
            global $_SETTINGS, $CUR_THEME;
            
            if( isset($CUR_THEME) && '' != $CUR_THEME) {
                include WPATH . 'share' . DS . 'themes' . DS . $CUR_THEME . DS . 'defs.php';
                return;
            }
            
            $pageYaml = yaml_load(WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml());
            if ( $pageYaml['theme'] == 'default' ) {
                $CUR_THEME = $_SETTINGS['theme']['name'];
                include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'defs.php';
            }
            else {
                $CUR_THEME = $pageYaml['theme'];
                include WPATH . 'share' . DS . 'themes' . DS . $pageYaml['theme'] . DS . 'defs.php';
            }
        }
        
        // Loads the theme
        public static function Load() {
            global $_SETTINGS, $CUR_THEME, $_APPS;
            
            if(isset($_GET['appId'])) {
                echo $_APPS[$_GET['appId']]; //needs work, but, its working fine as of now
                $appId = $_GET['appId'];
                echo "<script type=\"text/javascript\">\n";
                echo "$('form', $('#ajaxed_$appId')).submit ( function(e) {\n";
                echo "  e.preventDefault();\n";
                echo "  var data = $('input, textarea, select', $(this)).serialize();\n";
                echo "  $('#ajaxed_$appId').append('Working...');\n";
                echo "  $.post($(this).attr('action')+'?appId=$appId', data, function(ret) {\n";
                echo "    $('#ajaxed_$appId').html(ret);\n";
                $app = $_APPS[$appId]->getApp();
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
                return;
            }
            if( isset($CUR_THEME) && '' != $CUR_THEME) {
                include WPATH . 'share' . DS . 'themes' . DS . $CUR_THEME . DS . 'index.php'; // Loading is as simple as including index.php from the appropriate theme
                return;
            }
            
            $pageYaml = yaml_load(WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml());
            if ( $pageYaml['theme'] == 'default' ) {
                $CUR_THEME = $_SETTINGS['theme']['name'];
                include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'index.php';
            }
            else {
                $CUR_THEME = $pageYaml['theme'];
                include WPATH . 'share' . DS . 'themes' . DS . $pageYaml['theme'] . DS . 'index.php';
            }
        }
    }

?>
