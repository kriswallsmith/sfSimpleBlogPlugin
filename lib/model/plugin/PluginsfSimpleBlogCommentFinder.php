<?php

class PluginsfSimpleBlogCommentFinder extends Dbfinder
{
  protected $class = 'sfSimpleBlogComment';
  
  public function recent()
  {
    return $this->
      with('sfSimpleBlogPost')->
      where('IsModerated', false)->
      orderBy('CreatedAt', 'desc');
  }
  
  public function isAuthorApproved($author_name, $author_email)
  {
    $comment = $this->
      where('AuthorName', $author_name)->
      where('AuthorEmail', $author_email)->
      where('IsModerated', false)->
      findOne();
    
    return ($comment instanceof sfSimpleBlogComment);
  }
}