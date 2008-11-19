<?php

/**
 * Subclass for representing a row from the 'sf_blog_post' table.
 *
 * 
 *
 * @package plugins.sfSimpleBlogPlugin.lib.model
 */ 
class PluginsfSimpleBlogPost extends BasesfSimpleBlogPost
{
  protected $nbComments = null;
  
  public function setTitle($text)
  {
    if($this instanceof BaseObject)
    {
      parent::setTitle($text);
    }
    else
    {
      $this->rawSet('title', $text);
    }

    $this->setStrippedTitle(sfSimpleBlogTools::stripText($text)); 
  }

  public function getAuthor()
  {
    $getUserMethod = 'get'.sfConfig::get('app_sfSimpleBlog_user_class', 'sfGuardUser');
    if(is_callable(array($this, $getUserMethod)))
    {
      return $this->$getUserMethod();
    }
    else
    {
      throw new sfException(sprintf('Method sfSimpleBlogPost::%s() does not exist - check the sfSimpleBlog_user_class parameter of the app.yml file', $getUserMethod));
    }
  }

  public function getComments()
  {
    return DbFinder::from('sfSimpleBlogComment')->
      relatedTo($this)->
      where('IsModerated', false)->
      orderBy('CreatedAt')->
      find();
  }

  public function getNbComments()
  {
    if ($this->nbComments === null) 
    {
      $this->nbComments = DbFinder::from('sfSimpleBlogComment')->
        relatedTo($this)->
        where('IsModerated', false)->
        count();
    }
    
    return $this->nbComments;
  }

  public function getTagsAsString()
  {
    $tags = DbFinder::from('sfSimpleBlogTag')->
      relatedTo($this)->
      orderBy('Tag')->
      find();
    $ret = '';
    foreach ($tags as $tag)
    {
      $ret .= (empty($ret) ? '' : ' ') . (string) $tag;
    }
    
    return $ret;
  }

  public function setTagsAsString($tagString)
  {
    DbFinder::from('sfSimpleBlogTag')->
      relatedTo($this)->
      delete();
    $tags = explode(' ', $tagString);
    foreach ($tags as $tag)
    {
      if (!$tag) continue;
      $tagObject = new sfSimpleBlogTag();
      $tagObject->setTag($tag);
      $tagObject->setSfBlogPostId($this->getId());
      $tagObject->setsfSimpleBlogPost($this);
      $tagObject->save();
    }
  }

  public function getFeedLink()
  {
    return sfSimpleBlogTools::generatePostUri($this);
  }

  public function allowComments()
  {
    if ($this->getAllowComments())
    {
      $validity = sfConfig::get('app_sfSimpleBlog_comment_disable_after', 0);
      if ($validity == 0 || $this->getPublishedSinceDays() < $validity)
      {
        return true;
      }
    }

    return false;
  }

  public function getPublishedSinceDays()
  {
    return round((time() - $this->getPublishedAt('U')) / (24 * 60 * 60));
  }

  public function setIsPublished($flag)
  {
    if ($flag == true && !$this->getPublishedAt())
    {
      $this->setPublishedAt(date("Y-m-d"));
    }
    
    if($this instanceof BaseObject)
    {
      parent::setIsPublished($flag);
    }
    else
    {
      $this->rawSet('is_published', $flag);
    }
  }

}
