<?php

/**
 * Example form base class.
 *
 * @method Example getObject() Returns the current form's model object
 *
 * @package    By examples
 * @subpackage form
 * @author     gajdaw
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseExampleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'title'         => new sfWidgetFormInputText(),
      'lead'          => new sfWidgetFormTextarea(),
      'contents'      => new sfWidgetFormTextarea(),
      'number'        => new sfWidgetFormInputText(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
      'slug'          => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'comments_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Comment')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'lead'          => new sfValidatorString(array('max_length' => 4096, 'required' => false)),
      'contents'      => new sfValidatorString(array('max_length' => 4096, 'required' => false)),
      'number'        => new sfValidatorInteger(array('required' => false)),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'comments_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Comment', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Example', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('example[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Example';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['comments_list']))
    {
      $this->setDefault('comments_list', $this->object->Comments->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveCommentsList($con);

    parent::doSave($con);
  }

  public function saveCommentsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['comments_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Comments->getPrimaryKeys();
    $values = $this->getValue('comments_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Comments', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Comments', array_values($link));
    }
  }

}
