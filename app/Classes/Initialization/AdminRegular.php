<?php
namespace App\Classes\Initialization;

class AdminRegular{

    private $inquiry = null;
    private $view = 'pages.widgets.admin.stages.regular.';

    public function __construct($inquiry)
    {
        if ($inquiry == null){
            die();
        }
        $this->inquiry = $inquiry;

    }

    public function quotation(){

        if ($quotation = $this->inquiry->quotation){
            $status = 'sent';
            if ($quotation->status){
                $status = $quotation->status;
            }
        }else{
            $status = 'waiting';
        }

        return view($this->view.'quotation',['data'=>$this->inquiry,'status'=>$status]);

    }

    public function sample(){

        if ($sample = $this->inquiry->sample){

            $status = $sample->status;
            return view($this->view.'sample',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function pilot(){
        if ($pilot = $this->inquiry->pilot){
            $status = $pilot->status;
            return view($this->view.'pilot',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function pi(){
        if ($pilot = $this->inquiry->pilot){
            if($pilot->status == 'approved'){
                if ($this->inquiry->files()->where('type','pi')->count() > 0){
                    $status = 'sent';
                }else{
                    $status = 'waiting';
                }
                return view($this->view.'pi',['data'=>$this->inquiry,'status'=>$status]);
            }
        }
        return false;
    }

    public function po(){
        if ($this->inquiry->files()->where('type','pi')->count() > 0){
            if ($this->inquiry->files()->where('type','po')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'po',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function pcoa(){
        if ($this->inquiry->files()->where('type','po')->count() > 0){
            if ($this->inquiry->files()->where('type','pcoa')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'pcoa',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function draftShip(){
        if ($this->inquiry->pcoa_status == 'approved'){
            if ($this->inquiry->files()->where('type','draft')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'draft',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function finalShip(){
        if ($this->inquiry->draft_status == 'approved'){
            if ($this->inquiry->files()->where('type','final')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'final',['data'=>$this->inquiry,'status'=>$status]);
        }

    }

    public function trackNo(){
        if ($this->inquiry->final_status == 'approved'){
            if ($this->inquiry->tracking_number_of_original_documents){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'track',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function swift(){
        if ($this->inquiry->files()->where('type','po')->count() > 0){
            if ($this->inquiry->files()->where('type','swift')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'swift',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function end(){
        if ($this->inquiry->final_status == 'approved'){
            if ($this->inquiry->paid == 1 && $this->inquiry->files()->where('type','final')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'end',['data'=>$this->inquiry,'status'=>$status]);
        }

        return false;
    }

    public function run(){
        echo $this->quotation();
        echo $this->sample();
        echo $this->pilot();
        echo $this->pi();
        echo $this->po();
        echo $this->swift();
        echo $this->pcoa();
        echo $this->draftShip();
        echo $this->finalShip();
        echo $this->trackNo();
        echo $this->end();
    }

}
