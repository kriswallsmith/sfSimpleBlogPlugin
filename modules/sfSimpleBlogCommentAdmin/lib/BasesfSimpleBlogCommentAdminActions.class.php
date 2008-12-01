<?php

class BasesfSimpleBlogCommentAdminActions extends autosfSimpleBlogCommentAdminActions
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
    $comment = DbFinder::from('sfSimpleBlogComment')->findPk($this->getRequestParameter('id'));
    $this->forward404Unless($comment);
    $comment->setIsModerated(!$comment->getIsModerated());
    $comment->save();
    
    if($this->getRequestParameter('from_email') == 1)
    {
      $this->comment = $comment;
      return sfView::SUCCESS;
    }
    
    if($referer = $this->getRequest()->getReferer())
    {
      $this->redirect($referer);
    }
    else
    {
      $this->redirect('sfSimpleBlogCommentAdmin/list');
    }
  }
}
