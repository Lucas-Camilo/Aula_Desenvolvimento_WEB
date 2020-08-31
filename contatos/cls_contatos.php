<?php
class contatos
{
    private $idc;
    private $nomec;
    private $emailc;
    private $tipoc;
    function __construct($v_idc, $v_nomec, $v_emailc, $v_tipoc)
    {
        $this->idc = $v_idc;
        $this->nomec = $v_nomec;
        $this->emailc = $v_emailc;
        $this->tipoc = $v_tipoc;
    }
    public function getIdc()
    {
        return $this->idc;
    }
    public function getNomec()
    {
        return $this->nomec;
    }
    public function getEmailc()
    {
        return $this->emailc;
    }
    public function getTipoc()
    {
        return $this->tipoc;
    }
    public function setNomec($v_nomec)
    {
        $this->nomec = $v_nomec;
    }
    public function setEmailc($v_emailc)
    {
        $this->emailc = $v_emailc;
    }
    public function setTipoc($v_tipoc)
    {
        $this->tipoc = $v_tipoc;
    }
}