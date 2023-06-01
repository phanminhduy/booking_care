<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Notifications\AppointmentApprovedNotificationMail;
use App\Notifications\AppointmentRefusedNotificationMail;
use Illuminate\Support\Facades\Notification;

class AppointmentObserver
{
    public function updated(Appointment $appointment)
    {
        $customer_id=$appointment->customer_id;
        $customer=Customer::query()
            ->where('id','=',$customer_id)
            ->get();
        if($appointment->status==='2'){
            Notification::send($customer, new AppointmentApprovedNotificationMail($customer));
        }
        if($appointment->status==='3'){
            Notification::send($customer, new AppointmentRefusedNotificationMail($customer));
        }
    }
}
