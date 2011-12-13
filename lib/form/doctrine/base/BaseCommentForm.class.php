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
      'examples_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Example')),
      'projects_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Project')),
      'hints_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Hint')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'contents'      => new sfValidatorString(array('max_length' => 4096, 'required' => false)),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'examples_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Example', 'required' => false)),
      'projects_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Project', 'required' => false)),
      'hints_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Hint', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['examples_list']))
    {
      $this->setDefault('examples_list', $this->object->Examples->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['projects_list']))
    {
      $this->setDefault('projects_list', $this->object->Projects->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['hints_list']))
    {
      $this->setDefault('hints_list', $this->object->Hints->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveExamplesList($con);
    $this->saveProjectsList($con);
    $this->saveHintsList($con);

    parent::doSave($con);
  }

  public function saveExamplesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['examples_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Examples->getPrimaryKeys();
    $values = $this->getValue('examples_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Examples', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Examples', array_values($link));
    }
  }

  public function saveProjectsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['projects_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Projects->getPrimaryKeys();
    $values = $this->getValue('projects_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Projects', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Projects', array_values($link));
    }
  }

  public function saveHintsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['hints_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Hints->getPrimaryKeys();
    $values = $this->getValue('hints_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Hints', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Hints', array_values($link));
    }
  }

}
