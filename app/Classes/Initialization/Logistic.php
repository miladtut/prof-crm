<?php
namespace App\Classes\Initialization;
class Logistic{
    private $inquiry = null;
    private $view = 'pages.widgets.company.stages.logistic.';

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
        if ($this->inquiry->status_logs()->first()->status == 'sending po'){
            $from_po = true;
        }else{
            $from_po = false;
        }
        if ($this->inquiry->files()->where('type','pi')->count() > 0 || $from_po == true){
            if ($this->inquiry->files()->where('type','po')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'po',['data'=>$this->inquiry,'status'=>$status]);
        }

        return false;
    }

    public function swift(){
        if ($this->inquiry->s_po()->count() > 0){
            if ($this->inquiry->files()->where('type','swift')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'swift',['data'=>$this->inquiry,'status'=>$status]);
        }
        return false;
    }

    public function s_doc(){
        if ($this->inquiry->files()->where('type','po')->count() > 0){
            if ($this->inquiry->supplier_document()->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'supplier_doc',['data'=>$this->inquiry,'status'=>$status]);
        }
    }



    public function customer_doc(){
        if ($this->inquiry->supplier_document()->count() > 0){
            if ($this->inquiry->files()->where('type','customerdoc')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'customer_doc',['data'=>$this->inquiry,'status'=>$status]);
        }
    }

    public function pcoa(){
        if ($this->inquiry->files()->where('type','customerdoc')->count() > 0){
            if ($this->inquiry->files()->where('type','pcoa')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'pcoa',['data'=>$this->inquiry,'status'=>$status]);
        }
    }


    public function original_doc(){
        if ($this->inquiry->files()->where('type','pcoa')->count() > 0 && $this->inquiry->pcoa_status == 'approved'){
            if ($this->inquiry->files()->where('type','org')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'org',['data'=>$this->inquiry,'status'=>$status]);
        }
    }

    public function clearance_doc(){
        if ($this->inquiry->files()->where('type','org')->count() > 0){
            if ($this->inquiry->files()->where('type','clearance')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'clearance',['data'=>$this->inquiry,'status'=>$status]);
        }
    }

    public function notes_doc(){
        if ($this->inquiry->files()->where('type','clearance')->count() > 0){
            if ($this->inquiry->files()->where('type','notes')->count() > 0){
                $status = 'sent';
            }else{
                $status = 'waiting';
            }
            return view($this->view.'notes',['data'=>$this->inquiry,'status'=>$status]);
        }
    }

    public function end(){

        if ($this->inquiry->paid == 1 && $this->inquiry->status_name == 'inquiry closed successfully'){
            $status = 'sent';
            return view($this->view.'end',['data'=>$this->inquiry,'status'=>$status]);
        }else{
            $status = 'waiting';
            return view($this->view.'end',['data'=>$this->inquiry,'status'=>$status]);
        }
    }


    public function run(){
        echo $this->quotation();
        echo $this->sample();
        echo $this->pilot();
        echo $this->pi();
        echo $this->po();
        echo $this->swift();
        echo $this->s_doc();
        echo $this->customer_doc();
        echo $this->pcoa();
        echo $this->original_doc();
        echo $this->clearance_doc();
        echo $this->notes_doc();
        echo $this->end();
    }
}
