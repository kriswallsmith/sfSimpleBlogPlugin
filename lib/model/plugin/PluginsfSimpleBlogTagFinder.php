<?php

class PluginsfSimpleBlogTagFinder extends Dbfinder
{
  protected $class = 'sfSimpleBlogTag';

  public function findAllWithCount()
  {
    return $this->
      join('sfSimpleBlogPost p')->
      withColumn('count(p.Id)', 'count')->
      where('p.IsPublished', true)->
      groupBy('Tag')->
      find();
  }
}