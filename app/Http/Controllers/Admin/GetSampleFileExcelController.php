<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GetSampleFileExcelController extends Controller
{
    public function user(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'email' => 'Email của người dùng',
                    'password' => 'Mật khẩu người dùng',
                    'authentication' => 'Tình trạng người dùng đã được xác thực chưa. Giá trị 0 = chưa xác thực, 1= Đã được xác thực',
                    'type' => 'Loại tài khoản 1 = Admin, 2= doanh nghiệp, 3 = sinh viên',
                    'admin_id' => 'ID Admin, nếu không phải loại tài khoản Admin thì để trống',
                    'enterprise_id' => 'ID doanh nghiệp, nếu không phải loại tài khoản doanh nghiệp thì để trống',
                    'student_code' => 'Mã sinh viên, nếu không phải loại tài khoản sinh viên thì để trống'
                ];
                $sheet->fromArray(array(
                   $data
                ));
            });
        })->download('csv');
    }
    public function enterprise(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'name' => 'Tên doanh nghiệp',
                    'address' => 'Địa chỉ',
                    'name_president' => 'Tên giám đốc',
                    'phone_number' => 'Số điện thoại',
                    'email_address' => 'Địa chỉ Email, Email phải là duy nhất. Không được phép trùng với email đã tồn tại',
                    'introduce' => 'Mô tả về doanh nghiệp',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }
    public function work(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'student_code' => 'Mã sinh viên',
                    'enterprise_id' => 'Id doanh nghiệp',
                    'salary_id' => 'Id mức lương',
                    'rank_id' => 'Id chức vụ của sinh viên',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }


    public function course(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'code' => 'Mã khóa',
                    'name' => 'Tên khóa',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }
    public function department(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'code' => 'Mã khoa',
                    'name' => 'Tên khoa',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }
    public function branch(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'code' => 'Mã ngành',
                    'department_code' => 'Mã khoa',
                    'name' => 'Tên ngành',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }
    public function province(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'name' => 'Tên tỉnh/thành',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }
    public function student(){
        return Excel::create('sample', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $data = [
                    'code' => 'Mã sinh viên. Phải là duy nhất',
                    'first_name' => 'first name',
                    'last_name' => 'last name',
                    'full_name' => 'Tên đầy đủ',
                    'address' => 'Địa chỉ',
                    'sex' => 'Giới tính 0 = Nữ,1 = Nam',
                    'phone_number' => 'Số điện thoại',
                    'email_address' => 'Địa chỉ Email. Là địa chỉ duy nhất, không thể trùng',
                    'birth_day' => 'Ngày tháng năm sinh. Định dạng YYY-mm-dd',
                    'province_id' => 'ID tỉnh thành đang sống',
                    'rating_id' => 'ID hạng tốt nghiệp. Nếu chưa tốt nghiệp thì bỏ trống',
                    'introduce' => 'Thông tin thêm về sinh viên',
                    'graduated' => 'Tình trạng tốt nghiệp 0 = Chưa tốt nghiệp/ 1= Đã tốt nghiệp',
                    'medium_score' => 'Điểm trung bình tốt nghiệp, Nếu chưa tốt nghiệp thì để trống',
                    'date_graduated' => 'Ngày tốt nghiệp. Định dạng YYYY-mm-dd, Nếu chưa tốt nghiệp thì để trống',
                    'avatar' => 'Url Avatar sinh viên',
                    'course_code' => 'Mã khóa',
                    'branch_code' => 'Mã ngành',
                    'main_class' => 'Tên lớp',
                ];
                $sheet->fromArray(array(
                    $data
                ));
            });
        })->download('csv');
    }
}
