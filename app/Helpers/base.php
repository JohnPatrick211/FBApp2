<?php

namespace App\Helpers;
use DB, Auth, Session, Carbon\Carbon;
class base
{
    public static function getName()
    {
       return DB::table('tbl_users')->where('id', Auth::id())->value('name');
    }

    public static function getUserType()
    {
       return DB::table('tbl_users')->where('id', Auth::id())->value('user_type');
    }

    public static function getPenaltyDays()
    {
       return DB::table('tbl_penalty')->value('days');
    }

    public static function getPenaltyAmount()
    {
       return DB::table('tbl_penalty')->value('penalty');
    }

    public static function getBorrowerName($id)
    {
       return DB::table('tbl_users')->where('id', $id)->value('name');
    }

    public static function hasOneLeftBook($accession_no)
    {
        $row = DB::table('tbl_books as B')
                ->where('B.accession_no', $accession_no)
                ->where('copies', 1)
                ->get();

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function isBookAlreadyReserved($user_id, $accession_no)
    {
        $row = DB::table('tbl_book_reserve')
                ->where('user_id', $user_id)
                ->where('accession_no', $accession_no)
                ->get();

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function isLimitReached()
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', Auth::id())
                ->where('status', 0)
                ->get();

        if($row->count() == 3){
            return true;
        }else{
            return false;
        }
    }

    public static function isAlreadyBorrowed($id, $accession_no)
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', $id)
                ->where('accession_no', $accession_no)
                ->where('status', 0)
                ->get();

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function recordAction($name, $user_type, $module, $action)
    {
        DB::table('tbl_audit_trail')
            ->insert([
                'name' => $name,
                'user_type' => $user_type,
                'module' => $module,
                'action' => $action,
                'created_at' => Carbon::now()
            ]);
    }

    public static function convertDataToHTML($report_data, $date_from, $date_to, $report_title)
    {

        $output = '
        <style>
            .center img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            position:absolute;
            left:460px;
            }

            .right img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            position:absolute;
            left:750px;
            }
        </style>
        <div class="center">
        <img src="img/logo2.jpg" style="width:10%; align:middle;" >
        </div>
        <br> <br> <br> <br> <br>
        <p style = "text-align: center">Republic of the Philippines<br>
        Department of Labor and  Employment<br>
        Regional Office No. IV-A<br>
        Municipality of Balayan
        </p>

        <div style="width:100%">
        <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
        <br>
        <p><h1 style="text-align:center;">'.$report_title.' Report</h1>
        <h2 style="text-align:center;">For the Month of '.date("F", strtotime($date_from)).' '.date("Y", strtotime($date_from)).'</h2>
        <p style="text-align:left;">PESO BALAYAN</p>
         <table width="100%" style="border-collapse:collapse; border: 1px solid;">
            <tbody>
            <thead>
                <tr>
                    <th style="border: 1px solid;">ID</th>
                    <th style="border: 1px solid;">Name</th>
                    <th style="border: 1px solid;">Address</th>
                    <th style="border: 1px solid;">Sex</th>
                    <th style="border: 1px solid;">SEEKING EMPLOYMENT</th>
            </thead>
            
                ';

     
            if($report_data){
                foreach ($report_data as $data) {
                    $output .='
                    <tr>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. 'APC-'.$data->id .'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->name .'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->address .'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->gender.'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->status .'</td>
                </tr>
                ';
                }
            }
            else{
                echo "No data found";
            }


            $output .='
            </tbody>
        </table>
        <p style="text-align:left;">Note: The PESO shall accomplish the form on a monthly basis and submit its accomplishments to the Regional Office every last day of the succeeding month.
        </p>
        <br><br>
        <div class="right">
        <img src="img/signature.jpg" style="width:23%; " class="right" >
            </div>';

        return $output;
    }

    public static function convertVacantDataToHTML($report_data, $date_from, $date_to, $report_title)
    {

        $output = '
        <style>
            .center img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            position:absolute;
            left:460px;
            }

            .right img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            position:absolute;
            left:750px;
            }
        </style>
        <div class="center">
        <img src="img/logo2.jpg" style="width:10%; align:middle;" >
        </div>
        <br> <br> <br> <br> <br>
        <p style = "text-align: center">Republic of the Philippines<br>
        Department of Labor and  Employment<br>
        Regional Office No. IV-A<br>
        Municipality of Balayan
        </p>

        <div style="width:100%">
        <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
           <br>
        <p><h1 style="text-align:center;">'.$report_title.' Report</h1>
        <h2 style="text-align:center;">For the Month of '.date("F", strtotime($date_from)).' '.date("Y", strtotime($date_from)).'</h2>
     
        <p style="text-align:left;">PESO BALAYAN</p>
         <table width="100%" style="border-collapse:collapse; border: 1px solid;">
             <tbody>
            <thead>
                <tr>
                    <th style="border: 1px solid;">ID</th>
                    <th style="border: 1px solid;">Company name</th>
                    <th style="border: 1px solid;">Position</th>
                    <th style="border: 1px solid;">Region</th>
                    <th style="border: 1px solid;">Address</th>
            </thead>
           
                ';


            if($report_data){
                foreach ($report_data as $data) {
                    $output .='
                    <tr>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. 'JV-'.$data->id .'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->companyname .'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->jobtitle .'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->location.'</td>
                    <td style="border: 1px solid; text-align: center; padding:10px;">'. $data->address .'</td>
                </tr>
                ';

                }
            }
            else{
                echo "No data found";
            }


            $output .='
            </tbody>
        </table>
        <p style="text-align:left;">Note: The PESO shall accomplish the form on a monthly basis and submit its accomplishments to the Regional Office every last day of the succeeding month.
        </p>
        <br><br>
        <div class="right">
        <img src="img/signature.jpg" style="width:23%; " class="right" >
            </div>';

        return $output;
    }


    public static function CSVImporter($file)
    {
         // File Details
         $filename = $file->getClientOriginalName();
         $extension = $file->getClientOriginalExtension();
         $tempPath = $file->getRealPath();
         $fileSize = $file->getSize();
         $mimeType = $file->getMimeType();

         // Valid File Extensions
         $valid_extension = array("csv");

         // 2MB in Bytes
         $maxFileSize = 2097152;

         // Check file extension
         if(in_array(strtolower($extension),$valid_extension)){

           // Check file size
           if($fileSize <= $maxFileSize){

             // File upload location
             $location = 'uploads';

             // Upload file
             $file->move($location,$filename);

             // Import CSV to Database
             $filepath = "/home/u570681637/domains/pesobalayan-ojfs.online/public_html/".$location."/".$filename;
             

             // Reading file
             $file = fopen($filepath,"r");

             $importData_arr = array();
             $i = 0;

             while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );

                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                   $i++;
                   continue;
                }
                for ($c=0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
             }
             fclose($file);


                self::importPESO_Staff($importData_arr);




             Session::flash('message','Import Successful.');
           }else{
             Session::flash('message','File too large. File must be less than 2MB.');
           }

         }else{
            Session::flash('message','Invalid File Extension.');
         }
    }


    public static function importPESO_Staff($importData_arr)
    {
        $num_of_duplicate = 0;
        foreach($importData_arr as $data_col)
        {
            if(!self::isUserExist($data_col[0]))
            {
            DB::table('staff')
                ->insert([
                     'id' => $data_col[0],
                    'name' => $data_col[1],
                    'email' => $data_col[2],
                    'contactNo' => '0'.$data_col[3],
                    'address' => $data_col[4],
                    'username' => $data_col[5],
                    'password' => $data_col[6],
                    'archive_status' => $data_col[7],
                    'created_at' => date("Y-m-d", strtotime($data_col[8])),
                    // 'created_at' => $data_col[8],
                    'user_type' => $data_col[9],
                    'updated_at' => date("Y-m-d", strtotime($data_col[10])),
                    // 'updated_at' => $data_col[10],
                    //date("Y-m-d", strtotime($data_col[10])),

                ]);
            }else{
                $num_of_duplicate++;
            }
        }
        Session::put('NO_OF_DUPLICATES',$num_of_duplicate);

    }

        public static function importStudent($importData_arr)
        {
        $num_of_duplicate = 0;

            foreach($importData_arr as $data_col)
            {
                if(!self::isUserExist($data_col[0]))
                {

                    DB::table('tbl_users')
                        ->insert([
                            'user_id' => $data_col[0],
                            'name' => $data_col[1],
                            'password' => \Hash::make($data_col[0]),
                            'contact_no' => $data_col[2],
                            'address' => $data_col[3],
                            'user_type' => 2,
                            'archive_status' => 0
                        ]);

                        if(!self::isGradeExists($data_col[0]))
                        {
                            DB::table('tbl_grade')
                            ->insert([
                                'user_id' => $data_col[0],
                                'grade' => $data_col[4]
                            ]);
                        }
                }
                else{
                    $num_of_duplicate++;
                }
            }
            Session::put('NO_OF_DUPLICATES',$num_of_duplicate);
        }

    public static function isGradeExists($user_id){
        $row=DB::table('tbl_grade')
        ->where('user_id', $user_id)->get();
        return $row->count()>0 ? true : false;
    }

    public static function importTeacher($importData_arr)
    {
        $num_of_duplicate = 0;

        foreach($importData_arr as $data_col)
        {
            if(!self::isUserExist($data_col[0]))
            {

                DB::table('tbl_users')
                    ->insert([
                        'user_id' => $data_col[0],
                        'name' => $data_col[1],
                        'password' => \Hash::make($data_col[0]),
                        'contact_no' => $data_col[2],
                        'address' => $data_col[3],
                        'user_type' => 1,
                        'archive_status' => 0
                    ]);

                    if(!self::isDepartmentExists($data_col[0]))
                    {
                        DB::table('tbl_dept')
                        ->insert([
                            'user_id' => $data_col[0],
                            'department' => $data_col[4]
                        ]);
                    }

                }
                else{
                    $num_of_duplicate++;
                }

            }
            Session::put('NO_OF_DUPLICATES',$num_of_duplicate);
    }

    public static function isDepartmentExists($user_id)
    {
        $row=DB::table('tbl_grade')
        ->where('user_id', $user_id)->get();
        return $row->count()>0 ? true : false;
    }

    public static function getUserGrade($user_id)
    {
        return DB::table('tbl_grade')
                ->where('user_id', $user_id)->value('grade');
    }

    public static function getUserDepartment($user_id)
    {
        return DB::table('tbl_department')
                ->where('user_id', $user_id)->value('department');
    }

    public static function CSVExporter($users)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=file-export-'.date('Y-m-d h:s:m').'.csv');
        $output = fopen('php://output', 'w');


            fputcsv($output, array('id','name', 'email', 'contactNo', 'address','username','password','archive_status','created_at','user_type','updated_at'));



            if (count($users) > 0)
            {
                foreach ($users as $row)
                {
                    fputcsv($output, (array) $row);
                }
            }
    }

    public static function isUserExist($id)
    {
        $row = DB::table('staff')->where('id', $id);

        return $row->count() > 0 ? true : false;
    }

    public static function getCategoryID($category, $classification)
    {
      return DB::table('tbl_category')
                ->where('category', $category)
                ->where('classification', $classification)
                ->value('id');
    }

}
