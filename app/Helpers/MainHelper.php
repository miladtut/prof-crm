<?php


use Illuminate\Support\Str;

if (!function_exists('get_status_class')){
    function get_status_class($status){
        if(preg_match('#waiting#',$status)){
            return 'warning';
        }
        elseif (preg_match('#modif#',$status)){
            return 'danger';
        }
        else{
            return 'success';
        }
    }
}

if (!function_exists('get_status_id')){
    function get_status_id($status_name){
        $status = \App\Models\Status::where('name',$status_name)->first();
        return $status->id;
    }
}

if (!function_exists('upload')){
    function upload($path,$file){
        $name = Str::random(8).time().'-'.$file->getClientOriginalName();
        $final = $path.$name;
        $file->move(public_path().'/uploads/'.$path,$name);
        return $final;
    }


    if (!function_exists('checkOwner')){
        function checkOwner($inquiry = false){
            if ($inquiry){
                $id = $inquiry->company_id;
                if (auth()->user()->id == $id){
                    return true;
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }
    }

    if (!function_exists('setName')){
        function setName($path,$name){
            $info = pathinfo($path);
            $ext = $info['extension'];
            $out = $name.'.'.$ext;
            return $out;
        }
    }

    if (!function_exists('selectIf')){
        function selectIf(\App\Models\Inquiry $inquiry,$status){
             if ($inquiry->status_name == $status){
                 return 'selected';
             }
        }
    }



}


