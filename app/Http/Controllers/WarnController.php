<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WarnController extends Controller
{
    public function getFeeEmails()
    {
        $emailList = [];
        foreach (Auth::user()->consult as $class) {
            foreach ($class->member->where('role_id', 2) as $student) {
                $tongHocPhi = 0;
                $daNop = 0;
                foreach ($student->courses as $course) {
                    $tongHocPhi += $course->so_TC * 300000;
                    if ($course->pivot->is_dong_hoc) {
                        $daNop += $course->so_TC * 300000;
                    }
                }
                if ($tongHocPhi - $daNop != 0) {
                    $data = [
                        'email' => $student->email,
                        'fee' => $tongHocPhi - $daNop,
                        'subject' => 'Nhắc nhở đóng học phí',
                    ];
                    array_push($emailList, $data);
                }
            }
        }
        return $emailList;
    }
    public function warnHocPhiAll()
    {
        $emailList = $this->getFeeEmails();
        foreach ($emailList as $data) {
            $this->sendEmail('email.fee', $data);
        }
        // foreach (Auth::user()->consult as $class) {
        //     foreach ($class->member->where('role_id', 2) as $student) {
        //         $tongHocPhi = 0;
        //         $daNop = 0;
        //         foreach ($student->courses as $course) {
        //             $tongHocPhi += $course->so_TC * 300000;
        //             if ($course->pivot->is_dong_hoc) {
        //                 $daNop += $course->so_TC * 300000;
        //             }
        //         }
        //         if ($tongHocPhi - $daNop != 0) {
        //             // $student->email de lay ra email
        //             // $tongHocPhi - $daNop = so tien dang no
        //             $data = [
        //                 'email'   => $student->email,
        //                 'fee'     => $tongHocPhi - $daNop,
        //                 'subject' => 'Nhắc nhở đóng học phí',
        //             ];
        //             $this->sendEmail('email.fee', $data);
        //         }
        //     }
        // }
        return redirect('statistical');
    }
    public function warnHocPhi($id)
    {
        $student = User::find($id);
        $tongHocPhi = 0;
        $daNop = 0;
        foreach ($student->courses as $course) {
            $tongHocPhi += $course->so_TC * 300000;
            if ($course->pivot->is_dong_hoc) {
                $daNop += $course->so_TC * 300000;
            }
        }
        $this->sendEmail('email.fee', [
            'email' => $student->email,
            'fee' => $tongHocPhi - $daNop,
            'subject' => 'Nhắc nhở đóng học phí',
        ]);
        // $student->email de lay ra email
        // $tongHocPhi - $daNop = so tien dang no
        return redirect('statistical');
    }
    public function warnNghiHocAll()
    {
        foreach (Auth::user()->consult as $class) {
            foreach ($class->member->where('role_id', 2) as $student) {
                $soNam = (int) date('Y') - (int) substr($class->name, 3, 4);
                if ($soNam >= 7 || $student->so_lan_nhac_nho >= 9 || $student->SoTinNo >= 28) {
                    $data = [
                        'email' => $student->email,
                        'name' => $student->name,
                        'soLanNhacNho' => $student->so_lan_nhac_nho,
                        'gpa' => $student->gpa,
                        'soTinNo' => $student->SoTinNo,
                        'subject' => 'Nhắc nhở tình hình học tập',
                    ];
                    $this->sendEmail('email.gpa', $data);
                }
            }
        }
        return redirect('statistical');
    }
    public function warnNghiHoc($id)
    {
        $student = User::find($id);
        $this->sendEmail('email.gpa', [
            'email' => $student->email,
            'name' => $student->name,
            'soLanNhacNho' => $student->so_lan_nhac_nho,
            'gpa' => $student->gpa,
            'soTinNo' => $student->SoTinNo,
            'subject' => 'Nhắc nhở tình hình học tập',
        ]);
        // $student->email + $student->so_lan_nhac_nho + $student->SoTinNo
        return redirect('statistical');
    }

    private function sendEmail($view, $data)
    {
        /**
         * Send email with html view
         *
         * @param resource/views/email/reset '$view': html view of email body
         * @param $data : variables which used in view
         * @return \Illuminate\Http\Response
         */
        Mail::send($view, $data, function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }
}
