<?php if(isset($menucount)) $menucount += 1; else $menucount = 1; ?>
                        <li class="menu<?php echo $menucount; ?>"><a href="<?php echo $content['url']; ?>"><?php echo $content['text']; ?></a></li>
