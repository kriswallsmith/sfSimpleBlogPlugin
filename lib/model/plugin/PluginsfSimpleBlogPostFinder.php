<?php

class PluginsfSimpleBlogPostFinder extends Dbfinder
{
  protected $class = 'sfSimpleBlogPost';

  public function recent()
  {
    return $this->
      with(sfConfig::get('app_sfSimpleBlog_user_class', 'sfGuardUser'))->
      where('IsPublished', true)->
      orderBy('CreatedAt', 'desc');
  }

  public function tagged($tag)
  {
    return $this->
      join('sfSimpleBlogTag')->
      where('sfSimpleBlogTag.Tag', $tag);
  }
  
  public function withNbComments()
  {
    return $this->
      leftJoin('sfSimpleBlogComment c')->
      withColumn('COUNT(sfSimpleBlogComment.Id)', 'NbComments')->
      where('c.IsModerated', false)->
      groupBy('c.SfBlogPostId');
  }

  public function findByStrippedTitleAndDate($text, $date)
  {
    $this->where('StrippedTitle', $text);
    if (sfConfig::get('app_sfSimpleBlog_use_date_in_url', false))
    {
      $this->where('PublishedAt', $date);
    }

    return $this->findOne();
  }
}