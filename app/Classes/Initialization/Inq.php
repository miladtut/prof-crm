<?php
namespace App\Classes\Initialization;


use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class Inq{

    private $statuses = null;
    private $inquiry = null;
    private $inquiryType = null;
    private $manual_status = null;
    private $user_info = [
        'creator_type'=>null,
        'creator_id'=>null,
        'creator_name'=>null,
    ];

    public function __construct($manual = null)
    {
        $this->manual_status = $manual;
    }

    public function init($inquiry = null){
        if (@$inquiry->status_name == 'declined' && auth()->check()){
            return false;
        }
        if ($inquiry){
            $this->inquiry = $inquiry;
            $this->inquiryType = $this->inquiry->type;
            if (config('status.'.$this->inquiryType)){
                $this->statuses = config('status.'.$this->inquiryType);
            }else{
                return false;
            }
            if(auth('admin')->check()){
                $this->user_info['creator_type'] = 'admin' ;
                $this->user_info['creator_id'] = auth('admin')->user()->id ;
                $this->user_info['creator_name'] = auth('admin')->user()->admin_name ;
            }elseif(auth()->check()){
                checkOwner($this->inquiry);
                $this->user_info['creator_type'] = 'company' ;
                $this->user_info['creator_id'] = auth()->user()->id ;
                $this->user_info['creator_name'] = auth()->user()->company_name ;
            }else{
                return false;
            }
        }else{
            if (config('status.'.auth()->user()->account_type)){
                $this->statuses = config('status.'.auth()->user()->account_type);
            }else{
                return false;
            }
        }


    }


    public function makeQuotation($data){
        if (!$this->inquiry->quotation){
            $res = $this->inquiry->quotation()->create([
                'price'=>$data['price'],
                'currency_id'=>$data['currency_id'],
                'spec_id'=>$data['spec_id'],
                'lead_time'=>$data['lead_time'],
                'validity'=>$data['validity'],
                'shipping_term_id'=>$data['shipping_term_id'],
                'payment_term_id'=>$data['payment_term_id'],
                'origin_id'=>$data['origin_id'],
                'unit'=>$data['unit'],
            ]);
            if ($data['document']){
                $res->documents()->sync($data['document']);
            }
            return $res;
        }else{
            $res = $this->inquiry->quotation()->update($data);
            return $res;
        }
    }

    public function editQuotation($data){
        $res = $this->inquiry->quotation()->update($data);
        return $res;
    }

    public function makeSample($data){
        if (!$this->inquiry->sample){
            $res = $this->inquiry->sample()->create($data);
            return $res;
        }else{
            $res = $this->inquiry->sample()->update($data);
            return $res;
        }
    }

    public function editSample($data){
        $res = $this->inquiry->sample()->update($data);
        return $res;
    }

    public function makePilot($data){
        if (!$this->inquiry->pilot){
            $res = $this->inquiry->pilot()->create($data);
            return $res;
        }else{
            $res = $this->inquiry->pilot()->update($data);
            return $res;
        }
    }

    public function editPilot($data){
        $res = $this->inquiry->pilot()->update($data);
        return $res;
    }

    public function makePi($data){
        if ($data->hasfile('doc')) {
            foreach ($data->file('doc') as $doc) {
                $this->uploadFile(['type' => 'pi', 'name' => $doc]);
            }
        }
    }

    public function makePo($data){
        if ($data->hasfile('doc')) {
            foreach ($data->file('doc') as $doc) {
                $this->uploadFile(['type'=>'po','name'=>$doc]);
            }
        }
    }

    public function makePcoa($data){
        if ($data->hasfile('doc')) {
            foreach ($data->file('doc') as $doc) {
                $this->uploadFile(['type'=>'pcoa','name'=>$doc]);
            }
        }
    }

    public function fileApprove($type){
        $this->inquiry->update([
            $type.'_status'=>'approved'
        ]);
    }

    public function fileReject($type){
        $this->inquiry->update([
            $type.'_status'=>'rejected'
        ]);
    }

    public function makeDraft($data){
        if ($data->hasfile('doc')) {
            foreach ($data->file('doc') as $doc) {
                $this->uploadFile(['type'=>'draft','name'=>$doc]);
            }
        }

    }

    public function makeFinal($data){
        if ($data->hasfile('doc')) {
            foreach ($data->file('doc') as $doc) {
                $this->uploadFile(['type'=>'final','name'=>$doc]);
            }
        }
    }

    public function makeSwift($data){
        if ($data->hasfile('doc')) {
            foreach ($data->file('doc') as $doc) {
                $this->uploadFile(['type'=>'swift','name'=>$doc]);
            }
        }
    }

    public function makeTrack($data){
        $this->inquiry->update($data);
    }




    public function makeSupplierPo($data){
        $material_total_price = $data['material_qty'] * $data['material_price_per_unit'];
        $working_standard_total_price = $data['working_standard_qty'] * $data['working_standard_price_per_unit'];
        $po_total_price = $material_total_price + $working_standard_total_price;
        $ex = [
            'material_total_price'=>$material_total_price,
            'working_standard_total_price'=>$working_standard_total_price,
            'po_total_price'=>$po_total_price
            ];
        $data = array_merge($data,$ex);
        $this->inquiry->s_po()->create($data);
    }

    public function makeSupplierDocument($data){
        if ($data->hasfile('doc')) {

            foreach ($data->file('doc') as $doc) {
                $this->inquiry->supplier_document()->create([
                    'name' => 'supplier document',
                    'document' => $doc,
                    'supplier_id' => $this->inquiry->s_po->supplier->id
                ]);
            }
        }
    }




    public function makeCustomerDocument($data){
        if ($data->hasfile('doc')){

            foreach ($data->file('doc') as $doc){

                $this->uploadFile(['type'=>'customerdoc','name'=>$doc]);
            }

            if ($data->cdocs){
                $this->inquiry->customer_docs()->sync($data['cdocs']);
            }
        }
    }


    public function makeorg($data){
        if ($data->hasfile('doc')){

            foreach ($data->file('doc') as $doc){

                $this->uploadFile(['type'=>'org','name'=>$doc]);
            }


        }

    }

    public function makeClearance($data){
        if ($data->hasfile('doc')){

            foreach ($data->file('doc') as $doc){

                $this->uploadFile(['type'=>'clearance','name'=>$doc]);
            }


        }

    }

    public function makenotes($data){
        if ($data->hasfile('doc')){

            foreach ($data->file('doc') as $doc){

                $this->uploadFile(['type'=>'notes','name'=>$doc]);
            }


        }

    }


    public function changPaymentStatus($status){
        $this->inquiry->update(['paid'=>$status]);
    }

    public function approve($data){
        $data->update(['status'=>'approved']);
    }

    public function reject($data){
        $data->update(['status'=>'rejected']);
    }


    public function uploadFile($data){
        $res = $this->inquiry->files()->create($data);
        return $res;
    }


    public function userInfo(){
        return $this->user_info;
    }


    public function _getStatusName($array){
        $statusname = $this->statuses[$array[0]][$array[1]];//[$array[1]];
        return $statusname;
    }

    public function closeInquiry(){
        $this->inquiry->update([
            'paid'=>1,
        ]);
    }



    public function _continue($methods = null){

        if ($info = $this->user_info){
            if ($this->inquiry){
                if ($this->manual_status != null){
                    $next = $this->manual_status;
                }else{
                    $next = $this->inquiry->status + 1;
                }


                try {
                    DB::beginTransaction();
                    if ($methods){
                        foreach ($methods as $method){
                            $fun = $method['name'];
                            $data = $method['data'];
                            $this->$fun($data);
                        }
                    }
                    $this->inquiry->status_logs()->updateOrCreate(['status'=>$this->_getStatusName([$next,0])],[
                        'status'=>$this->_getStatusName([$next,0]),
                        'creator_type'=>$info['creator_type'],
                        'created_by'=>$info['creator_name'],
                        'creator_id'=>$info['creator_id']
                    ]);
                    $this->inquiry->update([
                        'status'=>$next,
                        'status_name'=>$this->_getStatusName([$next,0]),
                    ]);
                    if (auth('admin')->check()){
                        Notification::create([
                            'inquiry_id'=>$this->inquiry->id,
                            'title'=>'you inquiry #'.mb_substr($this->inquiry->company_name, 0, 3, "UTF-8").'-'.($this->inquiry->id**2).' Has Been Updated',
                            'company_id'=>$this->inquiry->company_id
                        ]);
                    }elseif (auth()->check()){
                        Notification::create([
                            'inquiry_id'=>$this->inquiry->id,
                            'title'=>'inquiry #'.$this->inquiry->id.' status has been changed to '.$this->inquiry->status_name,
                            'for_admin'=>'yes'
                        ]);
                    }
                    DB::commit();
                    return true;
                }catch (\Exception $exception){
                    DB::rollBack();
                    return false;
                }

            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function _reject($methods = null,$reason = null){
        if ($info = $this->user_info){
            if ($this->inquiry){
                $next = $this->inquiry->status + 1;

                try {
                    DB::beginTransaction();
                    if ($methods){
                        foreach ($methods as $method){
                            $fun = $method['name'];
                            $data = $method['data'];
                            $this->$fun($data);
                        }
                    }
                    $this->inquiry->status_logs()->create([
                        'status'=>$this->_getStatusName([$next,1]),
                        'creator_type'=>$info['creator_type'],
                        'created_by'=>$info['creator_name'],
                        'creator_id'=>$info['creator_id'],
                        'rejection_reason'=>$reason
                    ]);
                    $this->inquiry->update([
                        'status'=>$next,
                        'status_name'=>$this->_getStatusName([$next,1]),
                    ]);
                    if (auth('admin')->check()){
                        Notification::create([
                            'inquiry_id'=>$this->inquiry->id,
                            'title'=>'you inquiry #'.mb_substr($data->company_name, 0, 3, "UTF-8").'-'.($data->id**2).' Has Been Updated',
                            'company_id'=>$this->inquiry->company_id
                        ]);
                    }elseif (auth()->check()){
                        Notification::create([
                            'inquiry_id'=>$this->inquiry->id,
                            'title'=>'inquiry #'.$this->inquiry->id.' status has been changed to '.$this->inquiry->status_name,
                            'for_admin'=>'yes'
                        ]);
                    }
                    DB::commit();
                    return true;
                }catch (\Exception $exception){
                    DB::rollBack();
                    return false;
                }

            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
