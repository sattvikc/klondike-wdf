<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function PrimeGenerate_isPrime($num) {
        for($i = 2; $i <= $num /2; $i++) {
            if($num % $i == 0) return false;
        }
        return true;
    }
?>