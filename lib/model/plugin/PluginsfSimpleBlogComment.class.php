<?php

/**
 * Subclass for representing a row from the 'sf_blog_comment' table.
 *
 * 
 *
 * @package plugins.sfSimpleBlogPlugin.lib.model
 */ 
class PluginsfSimpleBlogComment extends BasesfSimpleBlogComment
{
  public function getPostTitle()
  {
    return $this->getsfSimpleBlogPost()->getTitle();
  }
  
  public function getFeedLink()
  {
    return sfSimpleBlogTools::generatePostUri($this->getsfSimpleBlogPost());
  }
}
