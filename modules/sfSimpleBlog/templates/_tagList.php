<h2><?php echo __('Tags') ?></h2>
<ul>
  <?php foreach($tags as $tag): ?>
  <li><?php echo link_to($tag->getTag(), 'sfSimpleBlog/showByTag?tag='.$tag->getTag()) ?> (<?php echo $tag->getColumn('count') ?>)</li>
  <?php endforeach; ?>
</ul>