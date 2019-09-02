<?php

/**
 * Created by PhpStorm.
 * User: yangkai
 * Date: 2019/8/17
 * Time: 下午3:42
 */

namespace yangkai\split\traits;

trait DecRule
{

    public function getDec($tableNum)
    {
        $rule = [];
        foreach($this->_createRuleField as $value)
        {
            if( !isset($this->$value) )
            {
                throw new \Exception("model The lack of：{$value} rule");
            }
            $rule[] = $this->$value;
        }

        $rule = implode(".",$rule);

        return $this->_tableNum($rule)%$tableNum;
    }

    protected function getDecDate()
    {
        return date($this->_createRuleDate,time());
    }



    /**
     * 获取一个表num
     * @param $rule
     * @return bool|string
     */
    private function _tableNum($rule)
    {
        return substr(crc32($rule),-3);
    }

}