<?php

/**
 * comment actions.
 *
 * @package    symfony-1-4-social-startup
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->comments = Doctrine_Core::getTable('Comment')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->comment = Doctrine_Core::getTable('Comment')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->comment);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CommentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CommentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($comment = Doctrine_Core::getTable('Comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
    $this->form = new CommentForm($comment);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($comment = Doctrine_Core::getTable('Comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
    $this->form = new CommentForm($comment);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($comment = Doctrine_Core::getTable('Comment')->find(array($request->getParameter('id'))), sprintf('Object comment does not exist (%s).', $request->getParameter('id')));
    $comment->delete();

    $this->redirect('comment/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {


    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {

      $value = $form->getValue('example');
      $example = Doctrine_Core::getTable('Example')->find(array($value));

      if ($example)
      {
        $comment = $form->save();
        $this->redirect('example/show?slug='.$example->getSlug());
      }

      $value = $form->getValue('project');
      $project = Doctrine_Core::getTable('Project')->find(array($value));

      if ($project)
      {
        $comment = $form->save();
        $this->redirect('project/show?slug='.$project->getSlug());
      }

      $value = $form->getValue('hint');
      $hint = Doctrine_Core::getTable('Hint')->find(array($value));
      if ($hint)
      {
        $comment = $form->save();
        $this->redirect('hint/show?slug='.$hint->getSlug());
      }

      //????
      //jaka akcja ma byc podjeta gdy brak example, project, hint?
      //$comment = $form->save();


    }
  }
}
