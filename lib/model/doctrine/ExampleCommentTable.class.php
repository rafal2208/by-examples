<?php

/**
 * ExampleCommentTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ExampleCommentTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ExampleCommentTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ExampleComment');
    }
}