<?php>
class tipo {
    private $nomet;

    function  __construct($v_nomet)
    {
        $this->nomet = $v_nomet;
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

<?>
