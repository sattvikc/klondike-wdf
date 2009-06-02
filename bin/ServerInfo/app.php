<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class ServerInfo extends App {
        
        public function info_view() {
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', "Server Specifications");
            $this->_CONTENT->CEcho('text', '');
            
            $this->_CONTENT->CEcho('text', "<table class=\"datatable\">\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>Operating System</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . PHP_OS . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>PHP Version</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . phpversion() . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>Software</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . $_SERVER['SERVER_SOFTWARE'] . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>Name</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . $_SERVER['SERVER_NAME'] . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>Address</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . $_SERVER['SERVER_ADDR'] . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>Port</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . $_SERVER['SERVER_PORT'] . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>URL</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . WURL . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>Installation Path</th>\n");
            $this->_CONTENT->CEcho('text', "<td>" . WPATH . "</td>\n");
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
        }
        
    }
    
?>