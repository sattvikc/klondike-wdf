        <div class="post">
          <div class="title">
          <h2  class="posttitle"><?php echo $content['title']; ?></h2>
          <div class="postdata"><span class="category"><?php if(isset($content['upperLeft']) && $content['upperLeft'] != '') echo $content['upperLeft']; ?></span> <span class="comments"><?php if(isset($content['upperRight']) && $content['upperRight'] != '') echo $content['upperRight']; ?></span></div>
          </div>
          <div class="entry">
            <?php echo $content['text']; ?>
          </div><!--entry -->
              <?php if(isset($content['lower']) && $content['lower'] != '') { ?><span class="tags"><?php echo $content['lower']; ?><br /></span><?php } ?>
        </div><!--post -->