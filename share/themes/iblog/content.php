        <div class="post">
          <div class="title">
          <h2  class="posttitle"><?php echo $CONTENT['title']; ?></h2>
          <div class="postdata"><span class="category"><?php if(isset($CONTENT['upperLeft']) && $CONTENT['upperLeft'] != '') echo $CONTENT['upperLeft']; ?></span> <span class="comments"><?php if(isset($CONTENT['upperRight']) && $CONTENT['upperRight'] != '') echo $CONTENT['upperRight']; ?></span></div>
          </div>
          <div class="entry">
            <?php echo $CONTENT['text']; ?>
          </div><!--entry -->
              <?php if(isset($CONTENT['lower']) && $CONTENT['lower'] != '') { ?><span class="tags"><?php echo $CONTENT['lower']; ?><br /></span><?php } ?>
        </div><!--post -->