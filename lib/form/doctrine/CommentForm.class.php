<?php

/**
 * Comment form.
 *
 * @package    symfony-1-4-social-startup
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{

  public function configure()
  {

    parent::setup();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['created_by'],
      $this['updated_by'],
      $this['examples_list'],
      $this['projects_list'],
      $this['hints_list']
    );

   $this->widgetSchema['example'] = new sfWidgetFormInputHidden();
   $this->widgetSchema['project'] = new sfWidgetFormInputHidden();
   $this->widgetSchema['hint'] = new sfWidgetFormInputHidden();


   $this->validatorSchema['example'] = new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array('-1'))),
          new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Example', 'required' => false))
   ));

   $this->validatorSchema['project'] = new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array('-1'))),
          new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Project', 'required' => false))
   ));

   $this->validatorSchema['hint'] = new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array('-1'))),
          new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Hint', 'required' => false))
   ));

   $this->widgetSchema->setDefaults(array(
        'example' => -1,
        'project' => -1,
        'hint' => -1,
   ));

  }


  protected function doSave($con = null)
  {

    $this->saveLinked($con);

    parent::doSave($con);

  }

  public function saveLinked($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    if (($e = $this->getValue('example')) && isset($e) && ($e != '-1')) {

        $this->object->link('Examples', array($e));

    } else if (($p = $this->getValue('project')) && isset($p) && ($p != '-1')) {

        $this->object->link('Projects', array($p));

    } else if (($h = $this->getValue('hint')) && isset($h) && ($h != '-1')) {

        $this->object->link('Hints', array($h));

    }

  }

}
