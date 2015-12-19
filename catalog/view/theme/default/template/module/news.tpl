<div class="list-group">
  <h4 href="javascript:;" class="list-group-item active">
    <?=$module_title?>
  </h4>
  <?php foreach ($news as $n) { ?>
    <?php if ($n['news_id'] == $news_id) { ?>
      <a href="<?php echo $n['href']; ?>" class="list-group-item active"><?php echo $n['name']; ?></a>
    <?php } else { ?>
      <a href="<?php echo $n['href']; ?>" class="list-group-item"><?php echo $n['name']; ?></a>
    <?php } ?>
  <?php } ?>
</div>
