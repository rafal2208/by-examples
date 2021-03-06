<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version2 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('comments', 'comments_created_by_sf_guard_user_id', array(
             'name' => 'comments_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('comments', 'comments_updated_by_sf_guard_user_id', array(
             'name' => 'comments_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('example_has_comment', 'example_has_comment_example_id_example_id', array(
             'name' => 'example_has_comment_example_id_example_id',
             'local' => 'example_id',
             'foreign' => 'id',
             'foreignTable' => 'example',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('example_has_comment', 'example_has_comment_example_id_comments_id', array(
             'name' => 'example_has_comment_example_id_comments_id',
             'local' => 'example_id',
             'foreign' => 'id',
             'foreignTable' => 'comments',
             ));
        $this->createForeignKey('example_has_comment', 'example_has_comment_comment_id_example_id', array(
             'name' => 'example_has_comment_comment_id_example_id',
             'local' => 'comment_id',
             'foreign' => 'id',
             'foreignTable' => 'example',
             ));
        $this->addIndex('comments', 'comments_created_by', array(
             'fields' => 
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('comments', 'comments_updated_by', array(
             'fields' => 
             array(
              0 => 'updated_by',
             ),
             ));
        $this->addIndex('example_has_comment', 'example_has_comment_example_id', array(
             'fields' => 
             array(
              0 => 'example_id',
             ),
             ));
        $this->addIndex('example_has_comment', 'example_has_comment_comment_id', array(
             'fields' => 
             array(
              0 => 'comment_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('comments', 'comments_created_by_sf_guard_user_id');
        $this->dropForeignKey('comments', 'comments_updated_by_sf_guard_user_id');
        $this->dropForeignKey('example_has_comment', 'example_has_comment_example_id_example_id');
        $this->dropForeignKey('example_has_comment', 'example_has_comment_example_id_comments_id');
        $this->dropForeignKey('example_has_comment', 'example_has_comment_comment_id_example_id');
        $this->removeIndex('comments', 'comments_created_by', array(
             'fields' => 
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('comments', 'comments_updated_by', array(
             'fields' => 
             array(
              0 => 'updated_by',
             ),
             ));
        $this->removeIndex('example_has_comment', 'example_has_comment_example_id', array(
             'fields' => 
             array(
              0 => 'example_id',
             ),
             ));
        $this->removeIndex('example_has_comment', 'example_has_comment_comment_id', array(
             'fields' => 
             array(
              0 => 'comment_id',
             ),
             ));
    }
}