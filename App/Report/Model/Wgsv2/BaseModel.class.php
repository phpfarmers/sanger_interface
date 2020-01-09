<?php
namespace Report\Model\Wgsv2;
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
        parent::__construct(array('controller_name' => 'Wgsv2'));
	}
}