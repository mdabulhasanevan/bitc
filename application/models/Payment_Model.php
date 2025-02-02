<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment_Model
 *
 * @author Evan DU
 */
class Payment_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetStudentforSetup($search) {

        $data = array();
        if ($search->Faculty != null) {
            $data['st.Faculty'] = $search->Faculty;
        }
        if ($search->SessionId != null) {
            $data['st.SessionId'] = $search->SessionId;
        }
        if ($search->Batch != null) {
            $data['Batch'] = $search->Batch;
        }
        if ($search->StudentInsID != null) {
            //$data['StudentInsID'] = $search->StudentInsID; this is temporary. after some days it will be change
            $data['st.RegNo'] = $search->StudentInsID;
        }

        $this->db->select('st.FullName as FullName,st.StudentInsID, st.Photo as Photo,
            st.StudentID as StudentID,
    st.RegNo as StudentRegNo,
    st.Faculty as FacultyID,
    f.Name AS FacultyName,
    b.BatchName AS BatchName,
    ss.Session AS SessionName,
    br.Branch AS BranchName,
    sc.Section AS SectionName,
   semesterX.Name AS RunningSemester,
    ps.MonthlyPay as MonthlyPay,
    ps.Off as Off,
    ps.Others as Others,
    ps.ID as PaymentID,
    ps.Payable as Payable');

        $this->db->from('student_tbl as st');
        $this->db->where($data);

        $this->db->join('faculty as f', 'f.FId = st.Faculty', 'left');
        $this->db->join('batch as b', 'b.BId = st.Batch', 'left');
        $this->db->join('session as ss', 'ss.SessionId = st.SessionId', 'left');
        $this->db->join('section as sc', 'sc.SectionId = st.SectionId', 'left');
        $this->db->join('branch as br', 'br.BranchId = st.BranchID', 'left');
        $this->db->join('other as ot', 'ot.Id = st.Gender', 'left');
        $this->db->join('other as ot2', 'ot2.Id = st.BloodGroup', 'left');
        $this->db->join('other as ot3', 'ot3.Id = st.Religion', 'left');
        $this->db->join('board as boards', ' boards.ID = st.ssc_board', 'left');
        $this->db->join('board as boardh', ' boardh.ID = st.hsc_board', 'left');
        $this->db->join('district as ds1', 'ds1.DistrictId=st.PreZila', 'left');
        $this->db->join('district as ds2', 'ds2.DistrictId=st.ParZila', 'left');
        $this->db->join('thana as tn1', 'tn1.PsId=st.PreThana', 'left');
        $this->db->join('thana as tn2', 'tn2.PsId=st.ParThana', 'left');
        $this->db->join('semesteryearpromotions as semesteryearpromotions', 'semesteryearpromotions.FacultyID=f.FId AND semesteryearpromotions.SessionID=ss.SessionId', 'left');
        $this->db->join('semester as semesterX', 'semesteryearpromotions.SemesterID=semesterX.ID', 'left');
        $this->db->join('major as maz', 'maz.ID=st.Major', 'left');

        $this->db->join('paymentsetup as ps', 'st.StudentID=ps.StudentID', 'left');


        $this->db->order_by("StudentInsID", "asc");

        $result = $this->db->get();


        return $result->result();
    }

    //for other payment related action
    public function GetStudent($search) {

        $data = array();
         $data2 = array();   //for StudentInsID search where or
        if ($search->Faculty != null) {
            $data['st.Faculty'] = $search->Faculty;
        }
        if ($search->SessionId != null) {
            $data['st.SessionId'] = $search->SessionId;
        }
        if ($search->Batch != null) {
            $data['st.Batch'] = $search->Batch;
        }
        if ($search->StudentInsID != null) {
            //$data['StudentInsID'] = $search->StudentInsID; this is temporary. after some days it will be change
            $data['st.RegNo'] = $search->StudentInsID;
            $data2['st.StudentInsID'] = $search->StudentInsID;
            
        }
        $data['st.IsNotActive'] = 0;

        $this->db->select('pmd.Deposit, st.StudentInsID as StudentInsID, st.FullName, st.Photo as Photo,pts.ID as PaymentID, '
                . 'st.StudentID as StudentID, f.Name AS FacultyName,ss.Session AS SessionName, st.Faculty as FacultyID,'
                . ' st.RegNo as StudentRegNo,'
                . ' pts.Payable as MonthlyPay,  (SUBSTRING(semr.Name, 1, 1)*6) as TotalMonth,'
                . ' sum(paid.Month) as TotalMonthPaid,'
                . ' ((SUBSTRING(semr.Name, 1, 1)*6)-sum(paid.Month))* pts.Payable as DueMoney ,'
                . ' (SUBSTRING(semr.Name, 1, 1)*6)-sum(paid.Month) as DueMonth,'
                . '  SUBSTRING(semr.Name, 1, 1) AS RunningSemester');

        $this->db->from('paymentsetup as pts');

        $this->db->join('paidmonthwisetable as paid', 'paid.StudentID = pts.StudentID', 'left');

        $this->db->join('student_tbl as st', 'st.StudentID = pts.StudentID', 'left');
        $this->db->join('semesteryearpromotions as syp', 'syp.FacultyID = st.Faculty and syp.SessionID=st.SessionId', 'left');
        $this->db->join('semester as semr', 'semr.ID = syp.SemesterID', 'left');
        $this->db->join('faculty as f', 'f.FId = st.Faculty', 'left');

        $this->db->join('session as ss', 'ss.SessionId = st.SessionId', 'left');
        $this->db->join('paymentmoneydeposit as pmd', 'pmd.StudentID=pts.StudentID', 'left');
        $this->db->where($data);
        $this->db->or_where($data2);

        $this->db->group_by("pts.StudentID");
        $this->db->order_by("st.StudentInsID", "asc");
        $result = $this->db->get();


        return $result->result();
    }

    public function GetFacultySessionWiseDue() {
        $Result = $this->db->query("SELECT pvt.FacultyName, pvt.SessionName, sum(pvt.DueMoney) as TotalDueMoney, sum(pvt.DueMonth) as TotalDueMonth, sum(pvt.Deposit) as TotalDeposit FROM paymentviewtable pvt group BY pvt.FacultyID, pvt.SessionId")->result();
        $Total = $this->db->query("SELECT  sum(pvt.DueMoney) as TotalDueMoney, sum(pvt.DueMonth) as TotalDueMonth, sum(pvt.Deposit) as TotalDeposit FROM paymentviewtable pvt")->row();
        return array(
            "All" => $Result,
            "Total" => $Total
        );
    }

    public function PaymentSetUpSave($Student) {
        $result;
        if ($Student != NULL) {
            foreach ($Student as $std) {

                if ($std->Off == NULL) {
                    $std->Off = 0;
                }
                if ($std->MonthlyPay == NULL) {
                    $std->MonthlyPay = 0;
                }

                $temp = array(
                    "StudentID" => $std->StudentID,
                    "MonthlyPay" => $std->MonthlyPay,
                    "Off" => $std->Off,
                    "Others" => $std->Others,
                    "CreatedBy" => $_SESSION["id"],
                    "Payable" => $std->MonthlyPay - ($std->MonthlyPay * ($std->Off / 100))
                );


                if ($std->PaymentID == NULL) {

                    $result = $this->db->insert('paymentsetup', $temp);
                } else {
                    $this->db->where(array('ID' => $std->PaymentID));
                    $result = $this->db->update("paymentsetup", $temp);
                }
            }
        }
        return $result;
    }

    //where paid amount 
    public function PaySubmitBill($PayInfo) {
        $CreatedDate = date(DATE_RSS, time(1140153693, 'UP6', TRUE));
        $PayInfo2 = array(
            "StudentID" => $PayInfo->StudentID,
            "Paid" => $PayInfo->Paid,
            "Type" => $PayInfo->Type,
            "Date" => $PayInfo->Date,
            "CreatedBy" => $_SESSION["id"],
            "Semester" => $PayInfo->Semester,
            "Month" => $PayInfo->Month,
            "Comment" => $PayInfo->Comment,
            "CreatedDate"=>$CreatedDate
        );
        $paidtable = $this->db->insert("paidtable", $PayInfo2);
        $LastInsPaidID = $this->db->insert_id();
        
        //sms
        if($PayInfo->SMS==TRUE)
        {
        $Student=$this->db->query("Select FullName,SMSNotificationNo From student_tbl where StudentID=$PayInfo->StudentID")->row();       
        $message=$Student->FullName.' You Paid '.$PayInfo->Paid.'tk. as Tution Fee  at '.$CreatedDate.' more detail bitc.ac.bd/StudentAuth/login' . PHP_EOL .' Accounts- BITC'; 
        $this->SemdSMSForPaySingleStudent($Student->SMSNotificationNo, $message);
        }
        // pay type 2 means it will be deposite not add in monthwisepaytable directly
        if ($PayInfo->Type == 2) {
            //first try to find any Deposit money if have then 
            $this->db->where(array('StudentID' => $PayInfo->StudentID));
            $count = $this->db->count_all_results('paymentmoneydeposit');

            // if Deposit table have not any amount then first add new data then 
            if ($count <= 0) {
                $DepositNewInfo = array("StudentID" => $PayInfo->StudentID, "Deposit" => $PayInfo->Paid);
                $AddIntoDeposit = $this->db->insert("paymentmoneydeposit", $DepositNewInfo);
            }
            //featch the present value of deposit table
            $this->db->where(array('StudentID' => $PayInfo->StudentID));
            $Deposite = $this->db->get('paymentmoneydeposit')->row();

            //if it is newly inputed 
            if ($count <= 0) {
                $TotalAmount = $Deposite->Deposit;
            } else {        //if it is not newly inputed
                $TotalAmount = $Deposite->Deposit + $PayInfo->Paid;
            }


            //if Total amount is become grater than Student one month Payment then devide it 
            if ($TotalAmount >= $PayInfo->MonthlyPay) { //MonthlyPay means which amount student pay Monthly
                $GetMonth = floor($TotalAmount / $PayInfo->MonthlyPay); //Like $GetMonth=3000/2200 That means 1 Month
                $ReminderDepositAmount = $TotalAmount % $PayInfo->MonthlyPay; //Like $ReminderDepositAmount=3000%2200 That means 800 Tk.
                $GetMoney = $TotalAmount - $ReminderDepositAmount; //Like 3000-800=2200
                //Update Deposit Table by New $ReminderDepositAmount
                $data = array("Deposit" => $ReminderDepositAmount);
                $this->db->where(array('StudentID' => $PayInfo->StudentID));
                $updateDeposit = $this->db->update("paymentmoneydeposit", $data);

                $PayInfoByDepositValue = array(
                    "StudentID" => $PayInfo->StudentID,
                    "Paid" => $GetMoney,
                    "Type" => 1, //1 Means Monthy Payment
                    "Date" => $PayInfo->Date,
                    "CreatedBy" => $_SESSION["id"],
                    "Semester" => $PayInfo->Semester,
                    "Month" => $GetMonth,
                    "Comment" => $PayInfo->Comment,
                    "PaytableID" => $LastInsPaidID,
                     "CreatedDate"=>$CreatedDate
                );
                $paidmonthwisetable = $this->db->insert("paidmonthwisetable", $PayInfoByDepositValue);
            } else {
                //if after adding new and old value it not become greater than monthly payment then it will just update paymentmoneydeposit by adding value
                $Depositdata = array("Deposit" => $TotalAmount);
                $this->db->where(array('StudentID' => $PayInfo->StudentID));
                $updateDeposit = $this->db->update("paymentmoneydeposit", $Depositdata);
            }
        }
        //that means if payment type be monthlypaymnet type==1 or not but 2 
        else if ($PayInfo->Type == 1) {
            //this amount will be save into  2. monthwisepaytable    
            $MonthWiseTableData = array(
                "StudentID" => $PayInfo->StudentID,
                "Paid" => $PayInfo->Paid,
                "Type" => $PayInfo->Type,
                "Date" => $PayInfo->Date,
                "CreatedBy" => $_SESSION["id"],
                "Semester" => $PayInfo->Semester,
                "Month" => $PayInfo->Month,
                "Comment" => $PayInfo->Comment,
                "PaytableID" => $LastInsPaidID,
                 "CreatedDate"=>$CreatedDate
            );
            $result2 = $this->db->insert("paidmonthwisetable", $MonthWiseTableData);
        }
        
        //sms
        
        return "Added Successfully";
    }

    public function GetPayHistory($StudentID) {
        $History = $this->db->query("SELECT paid.StudentID, paid.ID, paid.Type as TypeNumber, paid.paid as PaymentValue, paid.Date,paid.Month, paid.Comment, pt.Type as PayType, sem.Name as SemesterName, pts.Payable as Payable FROM `paidtable`as paid left JOIN paytype pt on pt.ID=paid.Type left join semester sem on sem.ID=paid.Semester left join paymentsetup pts on pts.StudentID=paid.StudentID WHERE paid.StudentID=$StudentID")->result();

        $TotalPaidAmountHistory = $this->db->query("SELECT sum(Paid) as TotalPaidAmount FROM `paidtable` WHERE StudentID=$StudentID")->row();

        $DueHistory = $this->db->query("SELECT (SUBSTRING(semr.Name, 1, 1)*6) as TotalMonth, sum(paid.Month) as TotalMonthPaid, ((SUBSTRING(semr.Name, 1, 1)*6)-sum(paid.Month))* pts.Payable as DueMoney , pts.Payable as MonthlyPay , (SUBSTRING(semr.Name, 1, 1)*6)-sum(paid.Month) as DueMonth,  SUBSTRING(semr.Name, 1, 1) AS RunningSemester FROM `paidmonthwisetable`as paid 
        left join paymentsetup pts on pts.StudentID=paid.StudentID 
        left join student_tbl st on st.StudentID=$StudentID
        left join semesteryearpromotions syp on syp.FacultyID=st.Faculty and syp.SessionID=st.SessionId
        left join semester semr on semr.ID=syp.SemesterID
        WHERE paid.StudentID=$StudentID ")->row();

        $this->db->where(array('StudentID' => $StudentID));
        $Deposit = $this->db->get('paymentmoneydeposit')->row();

        $data = array(
            "History" => $History,
            "TotalPaidAmountHistory" => $TotalPaidAmountHistory,
            "DueHistory" => $DueHistory,
            "Deposit" => $Deposit
        );
        return $data;
    }

    //its search for monthly report
    public function SearchAllPayHistory($search) {

        $History = $this->db->query("SELECT st.FullName, st.RegNo, paid.paid as PaymentValue, paid.Date,paid.Month, paid.Comment, pt.Type as PayType, "
                        . "sem.Name as SemesterName, pts.Payable as Payable "
                        . "FROM `paidtable`as paid left JOIN paytype pt on pt.ID=paid.Type"
                        . " left join semester sem on sem.ID=paid.Semester"
                        . " left join paymentsetup pts on pts.StudentID=paid.StudentID "
                        . "left join student_tbl st on st.StudentID=paid.StudentID"
                        . " WHERE paid.Date BETWEEN '$search->Date' and '$search->Date2' order by paid.Date asc")->result();

        $Total = $this->db->query("SELECT sum(paid.paid) as TotalAmount FROM `paidtable`as paid WHERE paid.Date BETWEEN '$search->Date' and '$search->Date2'")->row();
        $data = array(
            "History" => $History,
            "Total" => $Total
        );
        return $data;
    }

    public function DeleteTransaction($id) {
        $this->db->where(array("ID" => $id));
        $PaidTable = $this->db->get('paidtable')->row();

        if ($PaidTable->Type == 2) {     //if type be deposit; 2 means deposit
            //featch the present value of deposit table           
            $this->db->where(array('StudentID' => $PaidTable->StudentID));
            $Deposit = $this->db->get('paymentmoneydeposit')->row();

            $TotalAmount = ($Deposit->Deposit) - ($PaidTable->Paid);

            $Depositdata = array("Deposit" => $TotalAmount);
            $this->db->where(array('StudentID' => $PaidTable->StudentID));
            $updateDeposit = $this->db->update("paymentmoneydeposit", $Depositdata);

            $DeletedBy = $_SESSION["id"];
            $DeletedDate = date(DATE_RSS, time(1140153693, 'UP0', TRUE));
            $this->db->query("INSERT into paiddeletedtable SELECT 0 as DeletedID, pt.*, $DeletedBy as DeletedBy, '$DeletedDate' as DeletedDate from paidtable pt WHERE pt.ID=$id");

            $result = $this->db->delete("paidtable", array('ID' => $id));

            return $updateDeposit;
        } else {    //if it be general payment like monthly pay , reg tec
            //before deleation store it in paiddeleatedtable
            $DeletedBy = $_SESSION["id"];
            $DeletedDate = date(DATE_RSS, time(1140153693, 'UP0', TRUE));
            $this->db->query("INSERT into paiddeletedtable SELECT 0 as DeletedID, pt.*, $DeletedBy as DeletedBy, '$DeletedDate' as DeletedDate from paidtable pt WHERE pt.ID=$id");

            $result = $this->db->delete("paidtable", array('ID' => $id));
            $result2 = $this->db->delete("paidmonthwisetable", array('PaytableID' => $id));
            return $result;
        }
    }

    //deleted Payment will show here

    function DeletedPaymentList() {
        $result = $this->db->query("SELECT pdt.DeletedID,pdt.ID as TransactionID, pdt.Paid as PaidAmount, pt.Type as TypeName,pdt.Date,pdt.Month as MonthName,pdt.Comment, pdt.DeletedDate, st.FullName, f.Name as Faculty, s.Session, regCr.Name as ReceivedBy, regDe.Name as DeletedBy FROM paiddeletedtable pdt
LEFT join student_tbl st on st.StudentID=pdt.StudentID
LEFT join faculty f on f.FId=st.Faculty 
left join session s on s.SessionId=st.SessionId
left join registration regCr on regCr.Id=pdt.CreatedBy
left join registration regDe on regDe.Id=pdt.DeletedBy
left join paytype pt on pt.ID=pdt.Type order by pdt.DeletedID desc")->result();
        return $result;
    }

    //SMS
    public function SemdSMSForPaySingleStudent($mobile,$message)
    {
   
      //one to one
        try{
         $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
         $paramArray = array(
         'userName' => "01636978242",
         'userPassword' => "16557",
         'mobileNumber' => $mobile,
         'smsText' => $message,
         'type' => "TEXT",
         'maskName' => '',
         'campaignName' => '',
         );
         $value = $soapClient->__call("OneToOne", array($paramArray));
         echo $value->OneToOneResult;
        } catch (Exception $e) {
         echo $e->getMessage();
        }
    }
    
    
    
    
}
