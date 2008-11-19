<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sfSimpleBlogPlugin/css/admin.css') ?>

<div id="sf_admin_container">

<h1><?php echo __('Edit post "%%title%%"', 
array('%%title%%' => $sf_simple_blog_post->getTitle())) ?></h1>

<div id="sf_admin_header">
<?php include_partial('sfSimpleBlogPostAdmin/edit_header', array('sf_simple_blog_post' => $sf_simple_blog_post)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('sfSimpleBlogPostAdmin/edit_messages', array('sf_simple_blog_post' => $sf_simple_blog_post, 'labels' => $labels)) ?>
<?php include_partial('sfSimpleBlogPostAdmin/edit_form', array('sf_simple_blog_post' => $sf_simple_blog_post, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('sfSimpleBlogPostAdmin/edit_footer', array('sf_simple_blog_post' => $sf_simple_blog_post)) ?>
</div>

</div>

<?php echo slot('sfSimpleBlog_sidebar') ?>
<?php include_partial('sfSimpleBlog/administration') ?>
<?php echo end_slot() ?>
