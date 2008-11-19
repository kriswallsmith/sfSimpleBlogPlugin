<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('/sfSimpleBlogPlugin/css/admin.css') ?>

<div id="sf_admin_container">

<h1><?php echo __('List of blog posts', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('sfSimpleBlogPostAdmin/list_header', array('pager' => $pager)) ?>
<?php include_partial('sfSimpleBlogPostAdmin/list_messages', array('pager' => $pager)) ?>
</div>

<?php echo slot('sfSimpleBlog_sidebar') ?>
<?php include_partial('sfSimpleBlog/administration') ?>
<div id="sf_admin_bar">
<?php include_partial('filters', array('filters' => $filters)) ?>
</div>
<?php echo end_slot() ?>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<?php echo __('no result') ?>
<?php else: ?>
<?php include_partial('sfSimpleBlogPostAdmin/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('sfSimpleBlogPostAdmin/list_footer', array('pager' => $pager)) ?>
</div>

</div>
