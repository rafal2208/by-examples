<?php

/**
 * Comment form base class.
 *
 * @method Comment getObject() Returns the current form's model object
 *
 * @package    By examples
 * @subpackage form
 * @author     gajdaw
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentForm extends BaseFormDoctrine
{


  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'contents'      => new sfWidgetFormTextarea(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'example'       => new sfWidgetFormInputHidden(),
      'project'       => new sfWidgetFormInputHidden(),
      'hint'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'contents'      => new sfValidatorString(array('max_length' => 4096, 'required' => false)),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),

      'example' => new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array('-1'))),
          new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Example', 'required' => false))
      )),
      'project' => new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array('-1'))),
          new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Project', 'required' => false))
      )),
      'hint' => new sfValidatorOr(array(
          new sfValidatorChoice(array('choices' => array('-1'))),
          new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'Hint', 'required' => false))
      ))

    ));

    $this->getWidget('example')->setDefault(-1);
    $this->getWidget('project')->setDefault(-1);
    $this->getWidget('hint')->setDefault(-1);


    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
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
