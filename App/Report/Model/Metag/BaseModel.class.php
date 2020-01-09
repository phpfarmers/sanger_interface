<?php
namespace Report\Model\Metag;
/**
 * 
 *
 *
 * @return void
 */
class BaseModel extends \Report\Model\BaseModel
{

    public function __construct()
    {
        parent::__construct(array('controller_name' => 'Metag'));
    }
    
}