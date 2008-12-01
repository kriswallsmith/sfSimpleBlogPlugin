<?php

class BasesfSimpleBlogPostAdminActions extends autosfSimpleBlogPostAdminActions
{
  public function preExecute()
  {
    if(sfConfig::get('app_sfSimpleBlog_use_bundled_layout', true))
    {
      $this->setLayout(ProjectConfiguration::getActive()->getTemplateDir('sfSimpleBlog', 'layout.php').'/layout');
    }
  }

  public function executeTogglePublish()
  {
    $post = DbFinder::from('sfSimpleBlogPost')->findPk($this->getRequestParameter('id'));
    $this->forward404Unless($post);
    $post->setIsPublished(!$post->getIsPublished());
    $post->save();

    if($referer = $this->getRequest()->getReferer())
    {
      $this->redirect($referer);
    }
    else
    {
      $this->redirect('sfSimpleBlogPostAdmin/list');
    }
  }

  public function executeToggleComment()
  {
    $post = DbFinder::from('sfSimpleBlogPost')->findPk($this->getRequestParameter('id'));
    $this->forward404Unless($post);
    $post->setAllowComments(!$post->getAllowComments());
    $post->save();

    if($referer = $this->getRequest()->getReferer())
    {
      $this->redirect($referer);
    }
    else
    {
      $this->redirect('sfSimpleBlogPostAdmin/list');
    }
  }
}
