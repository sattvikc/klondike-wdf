<li <?php if(isset($content['class'])) echo 'class="page_item current_page_item"'; else echo 'class="page_item"'; ?>><a href="<?php echo $content['url']; ?>"><?php echo $content['text']; ?></a></li>
