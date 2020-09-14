<?php
class tipo 
{
    private $idt;
    private $nomet;
    function  __construct($v_idt, $v_nomet)
    {
        $this->idt = $v_idt;
        $this->nomet = $v_nomet;
    }
    public function getIdt()
    {
        return $this->idt;
    }
    public function setIdt($v_idt)
    {
        $this->idt = $v_idt;
    }
    public function getNomet()
    {
        return $this->nomet;
    }
    public function setNomet($v_nomet)
    {
        $this->nomet = $v_nomet;
    }
}

