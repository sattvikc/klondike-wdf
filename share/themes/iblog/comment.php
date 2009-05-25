<?php if(!isset($oddcomment)) $oddcomment=''; ?>
        <li class="<?php echo $oddcomment; ?>">
            
            <cite><?php echo $CONTENT['author']; ?></cite> Says:
            <br />
            <small class="commentmetadata"><?php echo $CONTENT['datetime']; ?></small>
            <?php echo $CONTENT['text'] ?>
        </li>
    <?php /* Changes every other comment to a different class */
        if ('alt' == $oddcomment) $oddcomment = '';
        else $oddcomment = 'alt';
    ?>
