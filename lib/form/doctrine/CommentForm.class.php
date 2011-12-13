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
      $this['updated_by']
    );

/*

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['created_by'],
      $this['updated_by'],
      $this['examples_list']
    );
    $this->setWidget('example_id', new sfWidgetFormInputHidden());
    $this->setValidator('examaple_id', new sfValidatorNumber(array('required' => false)));
*/

  }

/*
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['examples_list']))
    {
//      $this->setDefault('examples_list', $this->object->Panstwa->getPrimaryKeys());
      $this->setDefault('examples_list', array(4));
    }

  }
*/


}
