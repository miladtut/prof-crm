<?php
namespace App\Classes\Initialization;
class Backward{
    private $inquiry = null;
    private $step = null;
    private $status = null;
    private $coa = null;
    private $quotation = null;
    private $sample = null;
    private $pilot = null;
    private $pi= null;
    private $po= null;
    private $pcoa= null;
    private $draft= null;
    private $final= null;
    private $track = null;
    private $swift = null;
    public function __construct($inquiry =null)
    {
        if ($inquiry){
            $status = config('status.'.$inquiry->type);
            if ($inquiry->type == 'regular'){
                $this->status = [
                    $status[0][0],//0
                    $status[1][0],//1
                    $status[6][0],//2
                    $status[8][0],//3
                    $status[10][0],//4
                    $status[11][0],//5
                    $status[12][0],//6
                    $status[14][0],//7
                    $status[16][0],//8
                    $status[17][0],//9
                ];
            }
            if ($inquiry->type == 'logistic'){
                $this->status = [
                    $status[0][0],//0
                    $status[1][0],//1
                    $status[6][0],//2
                    $status[8][0],//3
                    $status[10][0],//4
                    $status[11][0],//5
                    $status[12][0],//6
                    $status[13][0],//7
                    $status[14][0],//8
                    $status[15][0],//9
                    $status[17][0],//10
                    $status[18][0],//11
                ];
            }

        }
        $this->inquiry = $inquiry;
    }
    private function u_inquiry(){
        $status = $this->inquiry->status_logs()->latest()->first()->status;
        if ($this->inquiry->type == 'logistic'){
            switch ($status){
                case 'waiting quotation':
                    $index = 0;
                    break;
                case 'quotation sent':
                    $index = 1;
                    break;
                case 'sample received':
                    $index = 6;
                    break;
                case 'waiting pilot price':
                    $index = 7;
                    break;
                case 'pilot price sent':
                    $index = 8;
                    break;
                case 'waiting PI':
                    $index = 9;
                    break;
                case 'sending PO':
                    $index = 10;
                    break;
                case 'waiting supplier documents':
                    $index = 12;
                    break;
                case 'sending customer documents':
                    $index = 13;
                    break;
                case 'waiting import approval':
                    $index = 14;
                    break;
                case 'PCOA shipping documents sent':
                    $index = 15;
                    break;
                case 'waiting original document':
                    $index = 16;
                    break;
                case 'sending customer clearance documents':
                    $index = 17;
                    break;
                case 'customer clearance documents sent':
                    $index = 18;
                    break;
                case 'delivery notes uploaded':
                    $index = 19;
                    break;
                default:$index = 0;
            }
        }else{
            switch ($status){
                case 'waiting quotation':
                    $index = 0;
                    break;
                case 'quotation sent':
                    $index = 1;
                    break;
                case 'sample received':
                    $index = 6;
                    break;
                case 'waiting pilot price':
                    $index = 7;
                    break;
                case 'pilot price sent':
                    $index = 8;
                    break;
                case 'waiting PI':
                    $index = 9;
                    break;
                case 'sending PO':
                    $index = 10;
                    break;
                case 'waiting PCOA':
                    $index = 11;
                    break;
                case 'PCOA sent':
                    $index = 12;
                    break;
                case 'draft ship files sent':
                    $index = 14;
                    break;
                case 'final ship files sent':
                    $index = 16;
                    break;
                case 'tracking number for original Documents':
                    $index = 17;
                    break;
                default:$index = 0;
            }
        }
        $this->inquiry->update([
            'status_name'=>$status,
            'status'=>$index,
            'paid'=>0
        ]);
    }
    private function d_log($status){
        $cur_status = $this->status[$status];
        $log = $this->inquiry->status_logs()->where('status',$cur_status)->first();
        if ($log){
            $this->inquiry->status_logs()->where('id','>',$log->id)->delete();
        }
    }

    private function unapprove_quotation(){
        $this->inquiry->quotation()->update([
            'status'=>null
        ]);
    }

    private function d_quotation(){
       $this->inquiry->quotation()->delete();
        $this->d_log(0);
       $this->u_inquiry();
    }

    private function unapprove_sample(){
        $this->inquiry->sample()->update([
            'status'=>'received'
        ]);
    }

    private function d_sample(){
        $this->inquiry->sample()->delete();
        $this->inquiry->files('where','rejection_report')->delete();
        $this->d_log(1);
        $this->u_inquiry();
    }

    private function unapprove_pilot(){
        $this->inquiry->pilot()->update([
            'status'=>'sent',
        ]);
    }

    private function d_pilot(){
        $this->inquiry->pilot()->delete();
        $this->d_log(2);
        $this->u_inquiry();
    }
    private function d_pi(){
        $files = $this->inquiry->files()->where('type','pi')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(3);
        $this->u_inquiry();
    }
    private function d_po(){
        $files = $this->inquiry->files()->where('type','po')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(4);
        $this->u_inquiry();
        if ($this->inquiry->type == 'logistic'){
            $this->inquiry->s_po()->delete();
            foreach ($this->inquiry->supplier_document()->get() as $doc){
                $doc->delete();
            }

        }
    }


    private function d_supplier_doc(){
        $files = $this->inquiry->supplier_document()->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->document))){
                unlink(asset('uploads/'.$file->document));
            }
            $file->delete();
        }
        $this->d_log(6);
        $this->u_inquiry();
    }

    private function d_customer_doc(){
        $files = $this->inquiry->files()->where('type','customerdoc')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(7);
        $this->u_inquiry();
    }

    private function unapprove_pcoa(){
        $this->inquiry->update([
            'pcoa_status'=>null
        ]);
    }

    private function d_pcoa(){
        $this->inquiry->update(['pcoa_status'=>null]);
        $files = $this->inquiry->files()->where('type','pcoa')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        if ($this->inquiry->type == 'logistic'){
            $this->d_log(8);
        }else{
            $this->d_log(5);
        }
        $this->u_inquiry();
    }

    private function d_org(){
        $files = $this->inquiry->files()->where('type','org')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(9);
        $this->u_inquiry();
    }

    private function d_clearance(){
        $files = $this->inquiry->files()->where('type','clearance')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(10);
        $this->u_inquiry();
    }

    private function d_notes(){
        $files = $this->inquiry->files()->where('type','notes')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(11);
        $this->u_inquiry();
    }

    private function unapprove_draft(){
        $this->inquiry->update([
            'draft_status'=>null
        ]);
    }

    private function d_draft(){
        $this->inquiry->update(['draft_status'=>null]);
        $files = $this->inquiry->files()->where('type','draft')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(6);
        $this->u_inquiry(6);
    }

    private function unapprove_final(){
        $this->inquiry->update([
            'final_status'=>null
        ]);
    }

    private function d_final(){
        $this->inquiry->update(['final_status'=>null]);
        $files = $this->inquiry->files()->where('type','final')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
        $this->d_log(7);
        $this->u_inquiry();
    }
    private function d_track(){
        $this->inquiry->update(['tracking_number_of_original_documents'=>null]);
        $this->d_log(8);
        $this->u_inquiry();
    }
    private function d_swift(){
        $files = $this->inquiry->files()->where('type','swift')->get();
        foreach ($files as $file){
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
            $file->delete();
        }
    }






    public function run_regular($step_from){
        switch ($step_from){
            case '0':
                $this->d_quotation();
                $this->d_sample();
                $this->d_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();
                break;
            case '1';
                $this->unapprove_quotation();
                $this->d_sample();
                $this->d_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();
                break;
            case '2';
                $this->unapprove_sample();
                $this->d_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();

                break;
            case '3';
                $this->unapprove_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();

                break;
            case '4';
                $this->d_po();
                $this->d_swift();
                $this->d_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();
                break;
            case '5';
                $this->d_swift();
                $this->d_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();
                break;
            case '6';

                $this->unapprove_pcoa();
                $this->d_draft();
                $this->d_final();
                $this->d_track();
                break;
            case '7';

                $this->unapprove_draft();
                $this->d_final();
                $this->d_track();
                break;
            case '8';
                $this->unapprove_final();
                $this->d_track();
                break;
            case '9';
                $this->d_track();
                break;

        }
    }


    public function run_logistic($step_from){
        switch ($step_from){
            case '0':
                $this->d_quotation();
                $this->d_sample();
                $this->d_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_supplier_doc();
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();

                break;
            case '1';
                $this->unapprove_quotation();
                $this->d_sample();
                $this->d_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_supplier_doc();
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '2';
                $this->unapprove_sample();
                $this->d_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_supplier_doc();
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '3';
                $this->unapprove_pilot();
                $this->d_pi();
                $this->d_po();
                $this->d_swift();
                $this->d_supplier_doc();
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '4';
                $this->d_po();
                $this->d_swift();
                $this->d_supplier_doc();
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '5';
                $this->d_swift();
                $this->d_supplier_doc();
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '6';
                $this->d_customer_doc();
                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '7';

                $this->d_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '8';
                $this->unapprove_pcoa();
                $this->d_org();
                $this->d_clearance();
                $this->d_notes();
                break;
            case '9';
                $this->d_clearance();
                $this->d_notes();
                break;
            case '10';
                $this->d_notes();
                break;
        }
    }
}
