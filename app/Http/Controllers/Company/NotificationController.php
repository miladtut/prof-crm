<?php

namespace App\Http\Controllers\Company;

use App\DataTables\NotificationDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(NotificationDataTable $dataTable){
        return $dataTable->render('pages.company.notifications.index');
    }
}
