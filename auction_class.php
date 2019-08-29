<?php
class auction
{
    private $name;
    private $surname;
    private $description;
    private $src;
    private $extencion_time;
    private $auction_id;
    function __construct($auction_id, $name, $surname, $decription, $src, $extencion_time)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->description = $decription;
        $this->src = $src;
        $this->extencion_time = $extencion_time;
        $this->auction_id = $auction_id;
    }


    public function json_type()
    {
        $arr = array('id'=>$this->auction_id, 'name' => $this->name, 'surname'=>$this->surname, 'description'=>$this->description, 'src'=>$this->src, 'exp_time'=>$this->extencion_time);
        return $arr;
    }

    public function time_check()
    {
        if($this->extencion_time <= time())return 0;
        else return 1;
    }
}
