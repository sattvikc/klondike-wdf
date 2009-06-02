<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    class HTML extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('html', $attributes);
        }
    }
    class HEAD extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('head', $attributes);
        }
    }
    class BODY extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('body', $attributes);
        }
    }
    class H1 extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('h1', $attributes);
        }
    }
    class H2 extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('h2', $attributes);
        }
    }
    class H3 extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('h3', $attributes);
        }
    }
    class H4 extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('h4', $attributes);
        }
    }
    class H5 extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('h5', $attributes);
        }
    }
    class H6 extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('h6', $attributes);
        }
    }
    class P extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('p', $attributes);
        }
    }
    class BR extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('br', $attributes);
        }
    }
    class HR extends Widget {
        public function __construct($attributes=array()) {
            parent::__construct('hr', $attributes);
        }
    }
?>