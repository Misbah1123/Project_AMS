<?php
session_start();

/* ===================== CHART OF ACCOUNTS ===================== */
if(!isset($_SESSION['coa'])) {
    $_SESSION['coa'] = [
        ["id"=>1,"code"=>"1001","name"=>"Cash Account","type"=>"Asset"],
        ["id"=>2,"code"=>"1002","name"=>"Bank Account","type"=>"Asset"],
        ["id"=>3,"code"=>"4001","name"=>"Sales Revenue","type"=>"Income"],
        ["id"=>4,"code"=>"5001","name"=>"Office Expense","type"=>"Expense"],
        ["id"=>5,"code"=>"2001","name"=>"Accounts Payable","type"=>"Liability"]
    ];
}
if(isset($_POST['add'])) {
    $_SESSION['coa'][] = ["id"=>time(),"code"=>$_POST['code'],"name"=>$_POST['name'],"type"=>$_POST['type']];
}
if(isset($_GET['delete'])) {
    foreach($_SESSION['coa'] as $k=>$r) if($r['id']==$_GET['delete']) unset($_SESSION['coa'][$k]);
}
$edit = null;
if(isset($_GET['edit'])) foreach($_SESSION['coa'] as $r) if($r['id']==$_GET['edit']) $edit=$r;
if(isset($_POST['update'])) {
    foreach($_SESSION['coa'] as &$r)
        if($r['id']==$_POST['id']) { $r['code']=$_POST['code']; $r['name']=$_POST['name']; $r['type']=$_POST['type']; }
}

/* ===================== GENERAL LEDGER ===================== */
if(!isset($_SESSION['ledger'])) {
    $_SESSION['ledger'] = [
        ["id"=>1,"code"=>"GL001","name"=>"Cash Account","debit"=>"5000","credit"=>"0"],
        ["id"=>2,"code"=>"GL002","name"=>"Bank Account","debit"=>"10000","credit"=>"0"],
        ["id"=>3,"code"=>"GL003","name"=>"Sales Revenue","debit"=>"0","credit"=>"15000"],
        ["id"=>4,"code"=>"GL004","name"=>"Office Expense","debit"=>"3000","credit"=>"0"]
    ];
}
if(isset($_POST['add_ledger'])) {
    $_SESSION['ledger'][] = ["id"=>time(),"code"=>$_POST['l_code'],"name"=>$_POST['l_name'],"debit"=>$_POST['l_debit'],"credit"=>$_POST['l_credit']];
}
if(isset($_GET['delete_ledger'])) {
    foreach($_SESSION['ledger'] as $k=>$r) if($r['id']==$_GET['delete_ledger']) unset($_SESSION['ledger'][$k]);
}
$editLedger = null;
if(isset($_GET['edit_ledger'])) foreach($_SESSION['ledger'] as $r) if($r['id']==$_GET['edit_ledger']) $editLedger=$r;
if(isset($_POST['update_ledger'])) {
    foreach($_SESSION['ledger'] as &$r)
        if($r['id']==$_POST['l_id']) { $r['code']=$_POST['l_code']; $r['name']=$_POST['l_name']; $r['debit']=$_POST['l_debit']; $r['credit']=$_POST['l_credit']; }
}

/* ===================== CASH RECEIPT VOUCHER ===================== */
if(!isset($_SESSION['crv'])) {
    $_SESSION['crv'] = [
        ["id"=>1,"voucher_no"=>"CRV-0001","date"=>"2026-06-01","received_from"=>"Ali Traders","account"=>"Sales Revenue","amount"=>"15000","description"=>"Payment against invoice #101","payment_mode"=>"Cash"],
        ["id"=>2,"voucher_no"=>"CRV-0002","date"=>"2026-06-05","received_from"=>"Sara Enterprises","account"=>"Cash Account","amount"=>"8000","description"=>"Advance received","payment_mode"=>"Bank Transfer"],
        ["id"=>3,"voucher_no"=>"CRV-0003","date"=>"2026-06-08","received_from"=>"Bilal & Co","account"=>"Bank Account","amount"=>"22000","description"=>"Full settlement","payment_mode"=>"Cheque"],
        ["id"=>4,"voucher_no"=>"CRV-0004","date"=>"2026-06-11","received_from"=>"Hamza Traders","account"=>"Sales Revenue","amount"=>"12500","description"=>"Partial payment invoice #110","payment_mode"=>"IBFT"],
        ["id"=>5,"voucher_no"=>"CRV-0005","date"=>"2026-06-12","received_from"=>"Noor Fabrics","account"=>"Cash Account","amount"=>"9800","description"=>"Cash sale receipt","payment_mode"=>"Cash"]
    ];
}
if(isset($_POST['add_crv'])) {
    $_SESSION['crv'][] = ["id"=>time(),"voucher_no"=>$_POST['crv_voucher_no'],"date"=>$_POST['crv_date'],"received_from"=>$_POST['crv_received_from'],"account"=>$_POST['crv_account'],"amount"=>$_POST['crv_amount'],"description"=>$_POST['crv_description'],"payment_mode"=>$_POST['crv_payment_mode']];
}
if(isset($_GET['delete_crv'])) {
    foreach($_SESSION['crv'] as $k=>$r) if($r['id']==$_GET['delete_crv']) unset($_SESSION['crv'][$k]);
}
$editCRV = null;
if(isset($_GET['edit_crv'])) foreach($_SESSION['crv'] as $r) if($r['id']==$_GET['edit_crv']) $editCRV=$r;
if(isset($_POST['update_crv'])) {
    foreach($_SESSION['crv'] as &$r)
        if($r['id']==$_POST['crv_id']) { $r['voucher_no']=$_POST['crv_voucher_no']; $r['date']=$_POST['crv_date']; $r['received_from']=$_POST['crv_received_from']; $r['account']=$_POST['crv_account']; $r['amount']=$_POST['crv_amount']; $r['description']=$_POST['crv_description']; $r['payment_mode']=$_POST['crv_payment_mode']; }
}

/* ===================== CASH PAYMENT VOUCHER ===================== */
if(!isset($_SESSION['cpv'])) {
    $_SESSION['cpv'] = [
        ["id"=>1,"voucher_no"=>"CPV-0001","date"=>"2026-06-02","paid_to"=>"Zafar Electronics","account"=>"Office Expense","amount"=>"7000","description"=>"Office equipment purchase","payment_mode"=>"Cash"],
        ["id"=>2,"voucher_no"=>"CPV-0002","date"=>"2026-06-06","paid_to"=>"Karachi Stationers","account"=>"Office Expense","amount"=>"2500","description"=>"Stationery items","payment_mode"=>"Cash"],
        ["id"=>3,"voucher_no"=>"CPV-0003","date"=>"2026-06-09","paid_to"=>"City Vendors Ltd","account"=>"Accounts Payable","amount"=>"18000","description"=>"Vendor payment - June","payment_mode"=>"Bank Transfer"],
        ["id"=>4,"voucher_no"=>"CPV-0004","date"=>"2026-06-12","paid_to"=>"Asad Furniture","account"=>"Office Expense","amount"=>"9500","description"=>"Office chairs purchase","payment_mode"=>"Cheque"],
        ["id"=>5,"voucher_no"=>"CPV-0005","date"=>"2026-06-13","paid_to"=>"Speed Couriers","account"=>"Office Expense","amount"=>"1500","description"=>"Courier charges","payment_mode"=>"Cash"]
    ];
}
if(isset($_POST['add_cpv'])) {
    $_SESSION['cpv'][] = ["id"=>time(),"voucher_no"=>$_POST['cpv_voucher_no'],"date"=>$_POST['cpv_date'],"paid_to"=>$_POST['cpv_paid_to'],"account"=>$_POST['cpv_account'],"amount"=>$_POST['cpv_amount'],"description"=>$_POST['cpv_description'],"payment_mode"=>$_POST['cpv_payment_mode']];
}
if(isset($_GET['delete_cpv'])) {
    foreach($_SESSION['cpv'] as $k=>$r) if($r['id']==$_GET['delete_cpv']) unset($_SESSION['cpv'][$k]);
}
$editCPV = null;
if(isset($_GET['edit_cpv'])) foreach($_SESSION['cpv'] as $r) if($r['id']==$_GET['edit_cpv']) $editCPV=$r;
if(isset($_POST['update_cpv'])) {
    foreach($_SESSION['cpv'] as &$r)
        if($r['id']==$_POST['cpv_id']) { $r['voucher_no']=$_POST['cpv_voucher_no']; $r['date']=$_POST['cpv_date']; $r['paid_to']=$_POST['cpv_paid_to']; $r['account']=$_POST['cpv_account']; $r['amount']=$_POST['cpv_amount']; $r['description']=$_POST['cpv_description']; $r['payment_mode']=$_POST['cpv_payment_mode']; }
}

/* ===================== TRANSFER VOUCHER ===================== */
if(!isset($_SESSION['tv'])) {
    $_SESSION['tv'] = [
        ["id"=>1,"voucher_no"=>"TV-0001","date"=>"2026-06-03","from_account"=>"Cash Account","to_account"=>"Bank Account","amount"=>"10000","description"=>"Cash deposited to bank"],
        ["id"=>2,"voucher_no"=>"TV-0002","date"=>"2026-06-07","from_account"=>"Bank Account","to_account"=>"Cash Account","amount"=>"5000","description"=>"Cash withdrawal for petty expenses"],
        ["id"=>3,"voucher_no"=>"TV-0003","date"=>"2026-06-11","from_account"=>"Bank Account","to_account"=>"Accounts Payable","amount"=>"7500","description"=>"Internal adjustment entry"]
    ];
}
if(isset($_POST['add_tv'])) {
    $_SESSION['tv'][] = ["id"=>time(),"voucher_no"=>$_POST['tv_voucher_no'],"date"=>$_POST['tv_date'],"from_account"=>$_POST['tv_from_account'],"to_account"=>$_POST['tv_to_account'],"amount"=>$_POST['tv_amount'],"description"=>$_POST['tv_description']];
}
if(isset($_GET['delete_tv'])) {
    foreach($_SESSION['tv'] as $k=>$r) if($r['id']==$_GET['delete_tv']) unset($_SESSION['tv'][$k]);
}
$editTV = null;
if(isset($_GET['edit_tv'])) foreach($_SESSION['tv'] as $r) if($r['id']==$_GET['edit_tv']) $editTV=$r;
if(isset($_POST['update_tv'])) {
    foreach($_SESSION['tv'] as &$r)
        if($r['id']==$_POST['tv_id']) { $r['voucher_no']=$_POST['tv_voucher_no']; $r['date']=$_POST['tv_date']; $r['from_account']=$_POST['tv_from_account']; $r['to_account']=$_POST['tv_to_account']; $r['amount']=$_POST['tv_amount']; $r['description']=$_POST['tv_description']; }
}

/* ===================== CHEQUE ISSUANCE TO PARTY ===================== */
if(!isset($_SESSION['ci'])) {
    $_SESSION['ci'] = [
        ["id"=>1,"cheque_no"=>"0451201","date"=>"2026-06-04","party_name"=>"Faisal Suppliers","account"=>"Accounts Payable","bank_name"=>"HBL","amount"=>"25000","status"=>"Cleared","description"=>"Payment for raw material"],
        ["id"=>2,"cheque_no"=>"0451202","date"=>"2026-06-08","party_name"=>"Noman Traders","account"=>"Office Expense","bank_name"=>"UBL","amount"=>"12000","status"=>"Pending","description"=>"Office rent June"],
        ["id"=>3,"cheque_no"=>"0451203","date"=>"2026-06-10","party_name"=>"Imran Hardware","account"=>"Accounts Payable","bank_name"=>"Meezan Bank","amount"=>"9000","status"=>"Bounced","description"=>"Hardware purchase - cheque returned"],
        ["id"=>4,"cheque_no"=>"0451204","date"=>"2026-06-12","party_name"=>"Tariq Logistics","account"=>"Office Expense","bank_name"=>"Allied Bank","amount"=>"16000","status"=>"Cleared","description"=>"Transport charges May-June"],
        ["id"=>5,"cheque_no"=>"0451205","date"=>"2026-06-13","party_name"=>"Sana Print Press","account"=>"Office Expense","bank_name"=>"HBL","amount"=>"4500","status"=>"Pending","description"=>"Printing & branding material"]
    ];
}
if(isset($_POST['add_ci'])) {
    $_SESSION['ci'][] = ["id"=>time(),"cheque_no"=>$_POST['ci_cheque_no'],"date"=>$_POST['ci_date'],"party_name"=>$_POST['ci_party_name'],"account"=>$_POST['ci_account'],"bank_name"=>$_POST['ci_bank_name'],"amount"=>$_POST['ci_amount'],"status"=>$_POST['ci_status'],"description"=>$_POST['ci_description']];
}
if(isset($_GET['delete_ci'])) {
    foreach($_SESSION['ci'] as $k=>$r) if($r['id']==$_GET['delete_ci']) unset($_SESSION['ci'][$k]);
}
$editCI = null;
if(isset($_GET['edit_ci'])) foreach($_SESSION['ci'] as $r) if($r['id']==$_GET['edit_ci']) $editCI=$r;
if(isset($_POST['update_ci'])) {
    foreach($_SESSION['ci'] as &$r)
        if($r['id']==$_POST['ci_id']) { $r['cheque_no']=$_POST['ci_cheque_no']; $r['date']=$_POST['ci_date']; $r['party_name']=$_POST['ci_party_name']; $r['account']=$_POST['ci_account']; $r['bank_name']=$_POST['ci_bank_name']; $r['amount']=$_POST['ci_amount']; $r['status']=$_POST['ci_status']; $r['description']=$_POST['ci_description']; }
}

/* ===================== CHEQUE RECEIVED FROM PARTY ===================== */
if(!isset($_SESSION['cr'])) {
    $_SESSION['cr'] = [
        ["id"=>1,"cheque_no"=>"0998871","date"=>"2026-06-03","party_name"=>"Ahsan Brothers","account"=>"Sales Revenue","bank_name"=>"HBL","amount"=>"30000","status"=>"Cleared","description"=>"Payment against invoice #205"],
        ["id"=>2,"cheque_no"=>"0998872","date"=>"2026-06-07","party_name"=>"Zain Traders","account"=>"Cash Account","bank_name"=>"UBL","amount"=>"14000","status"=>"Pending","description"=>"Advance for order #88"],
        ["id"=>3,"cheque_no"=>"0998873","date"=>"2026-06-10","party_name"=>"Madiha Textiles","account"=>"Sales Revenue","bank_name"=>"Meezan Bank","amount"=>"21000","status"=>"Bounced","description"=>"Cheque returned - insufficient funds"],
        ["id"=>4,"cheque_no"=>"0998874","date"=>"2026-06-12","party_name"=>"Kamran Enterprises","account"=>"Sales Revenue","bank_name"=>"Allied Bank","amount"=>"17500","status"=>"Cleared","description"=>"Final payment invoice #210"],
        ["id"=>5,"cheque_no"=>"0998875","date"=>"2026-06-13","party_name"=>"Rabia Garments","account"=>"Cash Account","bank_name"=>"HBL","amount"=>"6200","status"=>"Pending","description"=>"Advance for next order"]
    ];
}
if(isset($_POST['add_cr'])) {
    $_SESSION['cr'][] = ["id"=>time(),"cheque_no"=>$_POST['cr_cheque_no'],"date"=>$_POST['cr_date'],"party_name"=>$_POST['cr_party_name'],"account"=>$_POST['cr_account'],"bank_name"=>$_POST['cr_bank_name'],"amount"=>$_POST['cr_amount'],"status"=>$_POST['cr_status'],"description"=>$_POST['cr_description']];
}
if(isset($_GET['delete_cr'])) {
    foreach($_SESSION['cr'] as $k=>$r) if($r['id']==$_GET['delete_cr']) unset($_SESSION['cr'][$k]);
}
$editCR = null;
if(isset($_GET['edit_cr'])) foreach($_SESSION['cr'] as $r) if($r['id']==$_GET['edit_cr']) $editCR=$r;
if(isset($_POST['update_cr'])) {
    foreach($_SESSION['cr'] as &$r)
        if($r['id']==$_POST['cr_id']) { $r['cheque_no']=$_POST['cr_cheque_no']; $r['date']=$_POST['cr_date']; $r['party_name']=$_POST['cr_party_name']; $r['account']=$_POST['cr_account']; $r['bank_name']=$_POST['cr_bank_name']; $r['amount']=$_POST['cr_amount']; $r['status']=$_POST['cr_status']; $r['description']=$_POST['cr_description']; }
}

/* ===================== CHEQUE DEPOSIT ===================== */
if(!isset($_SESSION['cd'])) {
    $_SESSION['cd'] = [
        ["id"=>1,"cheque_no"=>"0998871","date"=>"2026-06-04","party_name"=>"Ahsan Brothers","deposit_account"=>"Bank Account","bank_name"=>"HBL","amount"=>"30000","status"=>"Cleared","description"=>"Deposited cheque against invoice #205"],
        ["id"=>2,"cheque_no"=>"0998872","date"=>"2026-06-08","party_name"=>"Zain Traders","deposit_account"=>"Bank Account","bank_name"=>"UBL","amount"=>"14000","status"=>"Pending","description"=>"Cheque sent for clearing"],
        ["id"=>3,"cheque_no"=>"0998874","date"=>"2026-06-13","party_name"=>"Kamran Enterprises","deposit_account"=>"Bank Account","bank_name"=>"Allied Bank","amount"=>"17500","status"=>"Cleared","description"=>"Deposited - invoice #210 settlement"]
    ];
}
if(isset($_POST['add_cd'])) {
    $_SESSION['cd'][] = ["id"=>time(),"cheque_no"=>$_POST['cd_cheque_no'],"date"=>$_POST['cd_date'],"party_name"=>$_POST['cd_party_name'],"deposit_account"=>$_POST['cd_deposit_account'],"bank_name"=>$_POST['cd_bank_name'],"amount"=>$_POST['cd_amount'],"status"=>$_POST['cd_status'],"description"=>$_POST['cd_description']];
}
if(isset($_GET['delete_cd'])) {
    foreach($_SESSION['cd'] as $k=>$r) if($r['id']==$_GET['delete_cd']) unset($_SESSION['cd'][$k]);
}
$editCD = null;
if(isset($_GET['edit_cd'])) foreach($_SESSION['cd'] as $r) if($r['id']==$_GET['edit_cd']) $editCD=$r;
if(isset($_POST['update_cd'])) {
    foreach($_SESSION['cd'] as &$r)
        if($r['id']==$_POST['cd_id']) { $r['cheque_no']=$_POST['cd_cheque_no']; $r['date']=$_POST['cd_date']; $r['party_name']=$_POST['cd_party_name']; $r['deposit_account']=$_POST['cd_deposit_account']; $r['bank_name']=$_POST['cd_bank_name']; $r['amount']=$_POST['cd_amount']; $r['status']=$_POST['cd_status']; $r['description']=$_POST['cd_description']; }
}

/* ===================== CASH DEPOSIT ===================== */
if(!isset($_SESSION['csd'])) {
    $_SESSION['csd'] = [
        ["id"=>1,"voucher_no"=>"CD-0001","date"=>"2026-06-05","account"=>"Bank Account","deposited_by"=>"Fiza Manager","amount"=>"20000","description"=>"Daily cash sales deposit"],
        ["id"=>2,"voucher_no"=>"CD-0002","date"=>"2026-06-09","account"=>"Bank Account","deposited_by"=>"Cashier - Ayesha","amount"=>"15000","description"=>"Weekly cash deposit"],
        ["id"=>3,"voucher_no"=>"CD-0003","date"=>"2026-06-12","account"=>"Bank Account","deposited_by"=>"Fiza Manager","amount"=>"8500","description"=>"Surplus cash deposited to bank"]
    ];
}
if(isset($_POST['add_csd'])) {
    $_SESSION['csd'][] = ["id"=>time(),"voucher_no"=>$_POST['csd_voucher_no'],"date"=>$_POST['csd_date'],"account"=>$_POST['csd_account'],"deposited_by"=>$_POST['csd_deposited_by'],"amount"=>$_POST['csd_amount'],"description"=>$_POST['csd_description']];
}
if(isset($_GET['delete_csd'])) {
    foreach($_SESSION['csd'] as $k=>$r) if($r['id']==$_GET['delete_csd']) unset($_SESSION['csd'][$k]);
}
$editCSD = null;
if(isset($_GET['edit_csd'])) foreach($_SESSION['csd'] as $r) if($r['id']==$_GET['edit_csd']) $editCSD=$r;
if(isset($_POST['update_csd'])) {
    foreach($_SESSION['csd'] as &$r)
        if($r['id']==$_POST['csd_id']) { $r['voucher_no']=$_POST['csd_voucher_no']; $r['date']=$_POST['csd_date']; $r['account']=$_POST['csd_account']; $r['deposited_by']=$_POST['csd_deposited_by']; $r['amount']=$_POST['csd_amount']; $r['description']=$_POST['csd_description']; }
}

/* ===================== CASH WITHDRAWAL ===================== */
if(!isset($_SESSION['csw'])) {
    $_SESSION['csw'] = [
        ["id"=>1,"voucher_no"=>"CW-0001","date"=>"2026-06-06","account"=>"Bank Account","withdrawn_by"=>"Fiza Manager","amount"=>"10000","description"=>"Petty cash replenishment"],
        ["id"=>2,"voucher_no"=>"CW-0002","date"=>"2026-06-10","account"=>"Bank Account","withdrawn_by"=>"Cashier - Ayesha","amount"=>"6000","description"=>"Office expenses cash"],
        ["id"=>3,"voucher_no"=>"CW-0003","date"=>"2026-06-13","account"=>"Bank Account","withdrawn_by"=>"Fiza Manager","amount"=>"4000","description"=>"Staff salary advance"]
    ];
}
if(isset($_POST['add_csw'])) {
    $_SESSION['csw'][] = ["id"=>time(),"voucher_no"=>$_POST['csw_voucher_no'],"date"=>$_POST['csw_date'],"account"=>$_POST['csw_account'],"withdrawn_by"=>$_POST['csw_withdrawn_by'],"amount"=>$_POST['csw_amount'],"description"=>$_POST['csw_description']];
}
if(isset($_GET['delete_csw'])) {
    foreach($_SESSION['csw'] as $k=>$r) if($r['id']==$_GET['delete_csw']) unset($_SESSION['csw'][$k]);
}
$editCSW = null;
if(isset($_GET['edit_csw'])) foreach($_SESSION['csw'] as $r) if($r['id']==$_GET['edit_csw']) $editCSW=$r;
if(isset($_POST['update_csw'])) {
    foreach($_SESSION['csw'] as &$r)
        if($r['id']==$_POST['csw_id']) { $r['voucher_no']=$_POST['csw_voucher_no']; $r['date']=$_POST['csw_date']; $r['account']=$_POST['csw_account']; $r['withdrawn_by']=$_POST['csw_withdrawn_by']; $r['amount']=$_POST['csw_amount']; $r['description']=$_POST['csw_description']; }
}

/* ===================== IBFT (INTERBANK FUNDS TRANSFER) ===================== */
if(!isset($_SESSION['ibft'])) {
    $_SESSION['ibft'] = [
        ["id"=>1,"voucher_no"=>"IBFT-0001","date"=>"2026-06-04","from_account"=>"Bank Account","to_bank"=>"Meezan Bank - Faisal Suppliers","reference_no"=>"IBFT20260604A","amount"=>"25000","description"=>"Payment to Faisal Suppliers via IBFT"],
        ["id"=>2,"voucher_no"=>"IBFT-0002","date"=>"2026-06-09","from_account"=>"Bank Account","to_bank"=>"UBL - Karachi Stationers","reference_no"=>"IBFT20260609B","amount"=>"2500","description"=>"Stationery payment via IBFT"],
        ["id"=>3,"voucher_no"=>"IBFT-0003","date"=>"2026-06-12","from_account"=>"Bank Account","to_bank"=>"HBL - Sana Print Press","reference_no"=>"IBFT20260612C","amount"=>"4500","description"=>"Printing material payment via IBFT"]
    ];
}
if(isset($_POST['add_ibft'])) {
    $_SESSION['ibft'][] = ["id"=>time(),"voucher_no"=>$_POST['ibft_voucher_no'],"date"=>$_POST['ibft_date'],"from_account"=>$_POST['ibft_from_account'],"to_bank"=>$_POST['ibft_to_bank'],"reference_no"=>$_POST['ibft_reference_no'],"amount"=>$_POST['ibft_amount'],"description"=>$_POST['ibft_description']];
}
if(isset($_GET['delete_ibft'])) {
    foreach($_SESSION['ibft'] as $k=>$r) if($r['id']==$_GET['delete_ibft']) unset($_SESSION['ibft'][$k]);
}
$editIBFT = null;
if(isset($_GET['edit_ibft'])) foreach($_SESSION['ibft'] as $r) if($r['id']==$_GET['edit_ibft']) $editIBFT=$r;
if(isset($_POST['update_ibft'])) {
    foreach($_SESSION['ibft'] as &$r)
        if($r['id']==$_POST['ibft_id']) { $r['voucher_no']=$_POST['ibft_voucher_no']; $r['date']=$_POST['ibft_date']; $r['from_account']=$_POST['ibft_from_account']; $r['to_bank']=$_POST['ibft_to_bank']; $r['reference_no']=$_POST['ibft_reference_no']; $r['amount']=$_POST['ibft_amount']; $r['description']=$_POST['ibft_description']; }
}

/* ===================== REPORTS ===================== */
$reportType   = $_GET['report_type']  ?? '';
$reportFrom   = $_GET['report_from']  ?? '';
$reportTo     = $_GET['report_to']    ?? '';
$reportGenerated = isset($_GET['generate_report']) && $reportType !== '';
$reportRows   = [];

function inDateRange($date, $from, $to) {
    if($from !== '' && $date < $from) return false;
    if($to   !== '' && $date > $to)   return false;
    return true;
}

if($reportGenerated) {
    switch($reportType) {

        case 'coa':
            $reportRows = $_SESSION['coa'];
            break;

        case 'ledger':
            $reportRows = $_SESSION['ledger'];
            break;

        case 'vouchers':
            foreach($_SESSION['crv'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cash Receipt Voucher","voucher_no"=>$r['voucher_no'],"date"=>$r['date'],"party"=>$r['received_from'],"account"=>$r['account'],"amount"=>$r['amount'],"nature"=>"Receipt"];
            }
            foreach($_SESSION['cpv'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cash Payment Voucher","voucher_no"=>$r['voucher_no'],"date"=>$r['date'],"party"=>$r['paid_to'],"account"=>$r['account'],"amount"=>$r['amount'],"nature"=>"Payment"];
            }
            foreach($_SESSION['tv'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Transfer Voucher","voucher_no"=>$r['voucher_no'],"date"=>$r['date'],"party"=>$r['from_account']." -> ".$r['to_account'],"account"=>"-","amount"=>$r['amount'],"nature"=>"Transfer"];
            }
            usort($reportRows, fn($a,$b)=>strcmp($a['date'],$b['date']));
            break;

        case 'banking':
            foreach($_SESSION['ci'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cheque Issuance","ref_no"=>$r['cheque_no'],"date"=>$r['date'],"party"=>$r['party_name'],"bank"=>$r['bank_name'],"amount"=>$r['amount'],"status"=>$r['status']];
            }
            foreach($_SESSION['cr'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cheque Received","ref_no"=>$r['cheque_no'],"date"=>$r['date'],"party"=>$r['party_name'],"bank"=>$r['bank_name'],"amount"=>$r['amount'],"status"=>$r['status']];
            }
            foreach($_SESSION['cd'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cheque Deposit","ref_no"=>$r['cheque_no'],"date"=>$r['date'],"party"=>$r['party_name'],"bank"=>$r['bank_name'],"amount"=>$r['amount'],"status"=>$r['status']];
            }
            foreach($_SESSION['csd'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cash Deposit","ref_no"=>$r['voucher_no'],"date"=>$r['date'],"party"=>$r['deposited_by'],"bank"=>$r['account'],"amount"=>$r['amount'],"status"=>"-"];
            }
            foreach($_SESSION['csw'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"Cash Withdrawal","ref_no"=>$r['voucher_no'],"date"=>$r['date'],"party"=>$r['withdrawn_by'],"bank"=>$r['account'],"amount"=>$r['amount'],"status"=>"-"];
            }
            foreach($_SESSION['ibft'] as $r) {
                if(inDateRange($r['date'],$reportFrom,$reportTo))
                    $reportRows[] = ["type"=>"IBFT","ref_no"=>$r['reference_no'],"date"=>$r['date'],"party"=>$r['to_bank'],"bank"=>$r['from_account'],"amount"=>$r['amount'],"status"=>"-"];
            }
            usort($reportRows, fn($a,$b)=>strcmp($a['date'],$b['date']));
            break;
    }
}

/* ===================== ACTIVE PAGE ===================== */
$activePage = 'Dashboard';
if(isset($_GET['edit']))            $activePage='coa';
if(isset($_GET['delete']))          $activePage='coa';
if(isset($_POST['add']))            $activePage='coa';
if(isset($_POST['update']))         $activePage='coa';
if(isset($_GET['edit_ledger']))     $activePage='ledger';
if(isset($_GET['delete_ledger']))   $activePage='ledger';
if(isset($_POST['add_ledger']))     $activePage='ledger';
if(isset($_POST['update_ledger']))  $activePage='ledger';
if(isset($_GET['edit_crv']))        $activePage='crv';
if(isset($_GET['delete_crv']))      $activePage='crv';
if(isset($_POST['add_crv']))        $activePage='crv';
if(isset($_POST['update_crv']))     $activePage='crv';
if(isset($_GET['edit_cpv']))        $activePage='cpv';
if(isset($_GET['delete_cpv']))      $activePage='cpv';
if(isset($_POST['add_cpv']))        $activePage='cpv';
if(isset($_POST['update_cpv']))     $activePage='cpv';
if(isset($_GET['edit_tv']))         $activePage='tv';
if(isset($_GET['delete_tv']))       $activePage='tv';
if(isset($_POST['add_tv']))         $activePage='tv';
if(isset($_POST['update_tv']))      $activePage='tv';
if(isset($_GET['edit_ci']))         $activePage='ci';
if(isset($_GET['delete_ci']))       $activePage='ci';
if(isset($_POST['add_ci']))         $activePage='ci';
if(isset($_POST['update_ci']))      $activePage='ci';
if(isset($_GET['edit_cr']))         $activePage='cr';
if(isset($_GET['delete_cr']))       $activePage='cr';
if(isset($_POST['add_cr']))         $activePage='cr';
if(isset($_POST['update_cr']))      $activePage='cr';
if(isset($_GET['edit_cd']))         $activePage='cd';
if(isset($_GET['delete_cd']))       $activePage='cd';
if(isset($_POST['add_cd']))         $activePage='cd';
if(isset($_POST['update_cd']))      $activePage='cd';
if(isset($_GET['edit_csd']))        $activePage='cashdeposit';
if(isset($_GET['delete_csd']))      $activePage='cashdeposit';
if(isset($_POST['add_csd']))        $activePage='cashdeposit';
if(isset($_POST['update_csd']))     $activePage='cashdeposit';
if(isset($_GET['edit_csw']))        $activePage='cashwithdraw';
if(isset($_GET['delete_csw']))      $activePage='cashwithdraw';
if(isset($_POST['add_csw']))        $activePage='cashwithdraw';
if(isset($_POST['update_csw']))     $activePage='cashwithdraw';
if(isset($_GET['edit_ibft']))       $activePage='ibft';
if(isset($_GET['delete_ibft']))     $activePage='ibft';
if(isset($_POST['add_ibft']))       $activePage='ibft';
if(isset($_POST['update_ibft']))    $activePage='ibft';
if($reportGenerated)                $activePage='reports';
// If a hidden "page" field is submitted with the form, it takes priority
if(isset($_POST['page']) && $_POST['page'] !== '') $activePage = $_POST['page'];
if(isset($_GET['page'])  && $_GET['page']  !== '') $activePage = $_GET['page'];

/* ===================== DASHBOARD CALCS ===================== */
$totalCOA    = count($_SESSION['coa']);
$totalLedger = count($_SESSION['ledger']);
$totalDebit  = array_sum(array_column($_SESSION['ledger'],'debit'));
$totalCredit = array_sum(array_column($_SESSION['ledger'],'credit'));
$totalCRV    = count($_SESSION['crv']);
$totalCRVAmt = array_sum(array_column($_SESSION['crv'],'amount'));
$totalCPV    = count($_SESSION['cpv']);
$totalCPVAmt = array_sum(array_column($_SESSION['cpv'],'amount'));
$totalTV     = count($_SESSION['tv']);
$totalTVAmt  = array_sum(array_column($_SESSION['tv'],'amount'));
$totalCI     = count($_SESSION['ci']);
$totalCIAmt  = array_sum(array_column($_SESSION['ci'],'amount'));
$totalCR     = count($_SESSION['cr']);
$totalCRAmt  = array_sum(array_column($_SESSION['cr'],'amount'));
$totalCD     = count($_SESSION['cd']);
$totalCDAmt  = array_sum(array_column($_SESSION['cd'],'amount'));
$totalCSD    = count($_SESSION['csd']);
$totalCSDAmt = array_sum(array_column($_SESSION['csd'],'amount'));
$totalCSW    = count($_SESSION['csw']);
$totalCSWAmt = array_sum(array_column($_SESSION['csw'],'amount'));
$totalIBFT   = count($_SESSION['ibft']);
$totalIBFTAmt= array_sum(array_column($_SESSION['ibft'],'amount'));
?>
<!DOCTYPE html>
<html>
<head>
<title>AMS Manager Panel</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif;}
body{display:flex;height:100vh;background:#9ad9ce;}

/* SIDEBAR */
.sidebar{width:240px;background:#3f9d92;color:white;padding-top:15px;overflow-y:auto;flex-shrink:0;}
.logo{text-align:center;font-size:18px;font-weight:bold;margin-bottom:20px;padding:0 10px;letter-spacing:1px;}
.sidebar a{display:flex;align-items:center;gap:10px;padding:13px 18px;color:white;text-decoration:none;font-size:14px;cursor:pointer;border-left:4px solid transparent;}
.sidebar a:hover{background:#2f7f76;}
.sidebar a.active{background:#2f7f76;border-left:4px solid white;}
.sidebar a .icon{font-size:18px;width:22px;text-align:center;}

/* MAIN */
.main{flex:1;padding:25px;overflow:auto;}

/* HEADER */
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;}
.topbar h1{color:#1f4f59;font-size:26px;font-weight:bold;}
.logout-btn{background:#e53935;color:white;padding:10px 22px;border-radius:6px;text-decoration:none;font-size:14px;font-weight:bold;}
.logout-btn:hover{background:#b71c1c;}

/* CARD */
.card{background:white;padding:25px;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.12);}
.section{display:none;}
.section.active{display:block;}
h2{color:#1f4f59;margin-bottom:20px;font-size:20px;display:flex;align-items:center;gap:8px;}

/* FORM INPUTS */
.form-row{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:15px;align-items:flex-end;}
.form-row input,.form-row select{padding:9px 11px;border:1px solid #ccc;border-radius:5px;font-size:14px;min-width:160px;}
.form-row input:focus,.form-row select:focus{outline:none;border-color:#3f9d92;}
.btn-primary{background:#3f9d92;color:white;border:none;padding:9px 20px;border-radius:5px;cursor:pointer;font-size:14px;}
.btn-primary:hover{background:#2f7f76;}
.btn-cancel{background:#888;color:white;padding:9px 16px;border-radius:5px;text-decoration:none;font-size:14px;margin-left:5px;}

/* TABLE */
table{width:100%;border-collapse:collapse;margin-top:15px;}
th{background:#3f9d92;color:white;padding:11px 10px;text-align:center;font-size:13px;}
td{border:1px solid #ddd;padding:10px;text-align:center;font-size:13px;}
tr:nth-child(even){background:#f7f7f7;}
tr:hover{background:#eef9f7;}
.btn-edit{background:#1565c0;color:white;padding:5px 14px;text-decoration:none;border-radius:5px;font-size:12px;margin-right:3px;}
.btn-delete{background:#e53935;color:white;padding:5px 14px;text-decoration:none;border-radius:5px;font-size:12px;}
.btn-edit:hover{background:#0d47a1;}
.btn-delete:hover{background:#b71c1c;}
.btn-edit, .btn-delete {
    display:inline-block;
    white-space:nowrap;
    margin:2px;
}
td:last-child {
    white-space:nowrap;
    min-width:140px;
}

/* DASHBOARD BOXES */
.dash-section-title{font-size:15px;font-weight:bold;color:#1f4f59;margin:22px 0 12px;border-left:4px solid #3f9d92;padding-left:10px;}
.dash-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(165px,1fr));gap:14px;margin-bottom:10px;}
.dash-box{background:white;border:1px solid #d0eeea;border-radius:10px;padding:18px 14px;text-align:center;box-shadow:0 2px 6px rgba(0,0,0,0.07);}
.dash-box .d-icon{font-size:28px;margin-bottom:8px;}
.dash-box .d-count{font-size:26px;font-weight:bold;color:#1f4f59;}
.dash-box .d-label{font-size:12px;color:#666;margin-top:4px;}

/* SUMMARY BOXES */
.summary-row{display:flex;gap:14px;margin:18px 0 8px;flex-wrap:wrap;}
.s-box{background:#e8f8f5;border-radius:8px;padding:13px 20px;text-align:center;}
.s-box .s-label{font-size:12px;color:#555;margin-bottom:3px;}
.s-box .s-val{font-size:22px;font-weight:bold;color:#1f4f59;}

/* BADGE */
.badge{padding:4px 10px;border-radius:20px;font-size:11px;font-weight:bold;}
.b-cash{background:#d4edda;color:#155724;}
.b-cheque{background:#fff3cd;color:#856404;}
.b-bank{background:#cce5ff;color:#004085;}
.b-ibft{background:#f3e5ff;color:#5a007a;}

/* FORM GRID */
.form-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;margin-bottom:18px;}
.form-group{display:flex;flex-direction:column;}
.form-group label{font-size:12px;color:#555;margin-bottom:4px;font-weight:bold;}
.form-group input,.form-group select{padding:9px 11px;border:1px solid #ccc;border-radius:5px;font-size:14px;}
.form-group input:focus,.form-group select:focus{outline:none;border-color:#3f9d92;}
.divider{border:none;border-top:1px solid #eee;margin:18px 0;}
.coming-soon{color:#aaa;font-style:italic;padding:10px 0;}

/* REPORTS */
.report-info{background:#f0fbf9;border:1px solid #d0eeea;border-radius:8px;padding:15px 18px;margin-bottom:20px;font-size:14px;color:#333;line-height:1.6;}
.report-info ul, .report-info ol{margin:8px 0 8px 22px;}
.report-list{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px;margin:10px 0 18px;}
.report-list-item{background:white;border:1px solid #d0eeea;border-radius:8px;padding:10px 14px;font-size:13px;color:#1f4f59;font-weight:bold;}
.report-output{margin-top:20px;}
.report-title{font-size:17px;font-weight:bold;color:#1f4f59;margin-bottom:5px;}
.report-meta{font-size:12px;color:#777;margin-bottom:15px;}
.btn-print{background:#1f4f59;color:white;border:none;padding:9px 20px;border-radius:5px;cursor:pointer;font-size:14px;}
.btn-print:hover{background:#163a42;}

@media print {
    body * { visibility: hidden; }
    .report-output, .report-output * { visibility: visible; }
    .report-output { position: absolute; left:0; top:0; width:100%; padding:20px; }
    .no-print { display:none !important; }
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">MANAGER PANEL</div>
    <a onclick="showPage('Dashboard')" id="nav-Dashboard"><span class="icon">🏠</span> Dashboard</a>
    <a onclick="showPage('coa')" id="nav-coa"><span class="icon">📊</span> Chart of Accounts</a>
    <a onclick="showPage('ledger')" id="nav-ledger"><span class="icon">📒</span> General Ledger Accounts</a>
    <a onclick="showPage('crv')" id="nav-crv"><span class="icon">💵</span> Cash Receipt Voucher</a>
    <a onclick="showPage('cpv')" id="nav-cpv"><span class="icon">💸</span> Cash Payment Voucher</a>
    <a onclick="showPage('tv')" id="nav-tv"><span class="icon">🔁</span> Transfer Voucher</a>
    <a onclick="showPage('ci')" id="nav-ci"><span class="icon">🏦</span> Cheque Issuance to Party</a>
    <a onclick="showPage('cr')" id="nav-cr"><span class="icon">📥</span> Cheque Received from Party</a>
    <a onclick="showPage('cd')" id="nav-cd"><span class="icon">🏦</span> Cheque Deposit</a>
    <a onclick="showPage('cashdeposit')" id="nav-cashdeposit"><span class="icon">💰</span> Cash Deposit</a>
    <a onclick="showPage('cashwithdraw')" id="nav-cashwithdraw"><span class="icon">🏧</span> Cash Withdrawal</a>
    <a onclick="showPage('ibft')" id="nav-ibft"><span class="icon">🔄</span> IBFT</a>
    <a onclick="showPage('reports')" id="nav-reports"><span class="icon">📑</span> Reports</a>
    <a href="login.php"><span class="icon">🚪</span> Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h1>Welcome fiza123 👋</h1>
        <a href="login.php" class="logout-btn">Logout</a>
    </div>

    <!-- ===== DASHBOARD ===== -->
    <div id="Dashboard" class="section">
    <div class="card">
        <h2>🏠 Dashboard Overview</h2>

        <div class="dash-section-title">Accounts Summary</div>
        <div class="dash-grid">
            <div class="dash-box"><div class="d-icon">📊</div><div class="d-count"><?php echo $totalCOA; ?></div><div class="d-label">Chart of Accounts</div></div>
            <div class="dash-box"><div class="d-icon">📒</div><div class="d-count"><?php echo $totalLedger; ?></div><div class="d-label">Ledger Entries</div></div>
            <div class="dash-box"><div class="d-icon">💰</div><div class="d-count"><?php echo number_format($totalDebit); ?></div><div class="d-label">Total Debit (PKR)</div></div>
            <div class="dash-box"><div class="d-icon">📤</div><div class="d-count"><?php echo number_format($totalCredit); ?></div><div class="d-label">Total Credit (PKR)</div></div>
        </div>

        <div class="dash-section-title">Vouchers & Transactions</div>
        <div class="dash-grid">
            <div class="dash-box"><div class="d-icon">💵</div><div class="d-count"><?php echo $totalCRV; ?></div><div class="d-label">Cash Receipt Voucher</div></div>
            <div class="dash-box"><div class="d-icon">💸</div><div class="d-count"><?php echo $totalCPV; ?></div><div class="d-label">Cash Payment Voucher</div></div>
            <div class="dash-box"><div class="d-icon">🔁</div><div class="d-count"><?php echo $totalTV; ?></div><div class="d-label">Transfer Voucher</div></div>
            <div class="dash-box"><div class="d-icon">🏦</div><div class="d-count"><?php echo $totalCI; ?></div><div class="d-label">Cheque Issuance</div></div>
            <div class="dash-box"><div class="d-icon">📥</div><div class="d-count"><?php echo $totalCR; ?></div><div class="d-label">Cheque Received</div></div>
            <div class="dash-box"><div class="d-icon">🏦</div><div class="d-count"><?php echo $totalCD; ?></div><div class="d-label">Cheque Deposit</div></div>
            <div class="dash-box"><div class="d-icon">💰</div><div class="d-count"><?php echo $totalCSD; ?></div><div class="d-label">Cash Deposit</div></div>
            <div class="dash-box"><div class="d-icon">🏧</div><div class="d-count"><?php echo $totalCSW; ?></div><div class="d-label">Cash Withdrawal</div></div>
            <div class="dash-box"><div class="d-icon">🔄</div><div class="d-count"><?php echo $totalIBFT; ?></div><div class="d-label">IBFT</div></div>
        </div>
    </div>
    </div>

    <!-- ===== CHART OF ACCOUNTS ===== -->
    <div id="coa" class="section">
    <div class="card">
        <h2>📊 Chart of Accounts</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $edit['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="coa">
            <div class="form-row">
                <input type="text" name="code" placeholder="Code" value="<?php echo htmlspecialchars($edit['code'] ?? ''); ?>" required>
                <input type="text" name="name" placeholder="Account Name" value="<?php echo htmlspecialchars($edit['name'] ?? ''); ?>" required>
                <select name="type">
                    <?php foreach(['Asset','Liability','Income','Expense'] as $t){
                        $s=(isset($edit['type'])&&$edit['type']==$t)?'selected':'';
                        echo "<option $s>$t</option>";
                    } ?>
                </select>
                <?php if($edit){ ?>
                    <button class="btn-primary" name="update">Update</button>
                    <a href="?page=coa" class="btn-cancel">Cancel</a>
                <?php } else { ?>
                    <button class="btn-primary" name="add">Add</button>
                <?php } ?>
            </div>
        </form>
        <table>
            <tr><th>ID</th><th>Code</th><th>Name</th><th>Type</th><th>Action</th></tr>
            <?php foreach($_SESSION['coa'] as $r){ ?>
            <tr>
                <td><?php echo $r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['code']); ?></td>
                <td><?php echo htmlspecialchars($r['name']); ?></td>
                <td><?php echo htmlspecialchars($r['type']); ?></td>
                <td>
                    <a class="btn-edit" href="?edit=<?php echo $r['id']; ?>&page=coa">Edit</a>
                    <a class="btn-delete" href="?delete=<?php echo $r['id']; ?>&page=coa" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== GENERAL LEDGER ===== -->
    <div id="ledger" class="section">
    <div class="card">
        <h2>📒 General Ledger Accounts</h2>
        <form method="POST">
            <input type="hidden" name="l_id" value="<?php echo $editLedger['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="ledger">
            <div class="form-row">
                <input type="text" name="l_code" placeholder="Ledger Code" value="<?php echo htmlspecialchars($editLedger['code'] ?? ''); ?>" required>
                <input type="text" name="l_name" placeholder="Account Name" value="<?php echo htmlspecialchars($editLedger['name'] ?? ''); ?>" required>
                <input type="number" name="l_debit" placeholder="Debit" value="<?php echo htmlspecialchars($editLedger['debit'] ?? ''); ?>" required>
                <input type="number" name="l_credit" placeholder="Credit" value="<?php echo htmlspecialchars($editLedger['credit'] ?? ''); ?>" required>
                <?php if($editLedger){ ?>
                    <button class="btn-primary" name="update_ledger">Update</button>
                    <a href="?page=ledger" class="btn-cancel">Cancel</a>
                <?php } else { ?>
                    <button class="btn-primary" name="add_ledger">Add</button>
                <?php } ?>
            </div>
        </form>
        <table>
            <tr><th>ID</th><th>Code</th><th>Name</th><th>Debit</th><th>Credit</th><th>Action</th></tr>
            <?php foreach($_SESSION['ledger'] as $r){ ?>
            <tr>
                <td><?php echo $r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['code']); ?></td>
                <td><?php echo htmlspecialchars($r['name']); ?></td>
                <td><?php echo htmlspecialchars($r['debit']); ?></td>
                <td><?php echo htmlspecialchars($r['credit']); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_ledger=<?php echo $r['id']; ?>&page=ledger">Edit</a>
                    <a class="btn-delete" href="?delete_ledger=<?php echo $r['id']; ?>&page=ledger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CASH RECEIPT VOUCHER ===== -->
    <div id="crv" class="section">
    <div class="card">
        <h2>💵 Cash Receipt Voucher</h2>
        <form method="POST">
            <input type="hidden" name="crv_id" value="<?php echo $editCRV['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="crv">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="crv_voucher_no" placeholder="CRV-0001"
                        value="<?php echo htmlspecialchars($editCRV['voucher_no'] ?? ('CRV-'.str_pad(count($_SESSION['crv'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="crv_date" value="<?php echo htmlspecialchars($editCRV['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Received From</label>
                    <input type="text" name="crv_received_from" placeholder="Customer / Party name"
                        value="<?php echo htmlspecialchars($editCRV['received_from'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Account</label>
                    <select name="crv_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCRV['account'])&&$editCRV['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="crv_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCRV['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Payment Mode</label>
                    <select name="crv_payment_mode" required>
                        <?php foreach(['Cash','Cheque','Bank Transfer','IBFT'] as $m){
                            $s=(isset($editCRV['payment_mode'])&&$editCRV['payment_mode']==$m)?'selected':'';
                            echo "<option $s>$m</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="crv_description" placeholder="Notes or remarks..."
                        value="<?php echo htmlspecialchars($editCRV['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCRV){ ?>
                <button class="btn-primary" name="update_crv">✏️ Update Voucher</button>
                <a href="?page=crv" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_crv">➕ Add Voucher</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Vouchers</div><div class="s-val"><?php echo count($_SESSION['crv']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Received (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['crv'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Received From</th><th>Account</th><th>Amount (PKR)</th><th>Payment Mode</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['crv'])){ ?>
            <tr><td colspan="9" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['crv']) as $r){
                $bc=match($r['payment_mode']){'Cash'=>'b-cash','Cheque'=>'b-cheque','Bank Transfer'=>'b-bank','IBFT'=>'b-ibft',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['received_from']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge <?php echo $bc; ?>"><?php echo htmlspecialchars($r['payment_mode']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_crv=<?php echo $r['id']; ?>&page=crv">Edit</a>
                    <a class="btn-delete" href="?delete_crv=<?php echo $r['id']; ?>&page=crv" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CASH PAYMENT VOUCHER ===== -->
    <div id="cpv" class="section">
    <div class="card">
        <h2>💸 Cash Payment Voucher</h2>
        <form method="POST">
            <input type="hidden" name="cpv_id" value="<?php echo $editCPV['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cpv">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="cpv_voucher_no" placeholder="CPV-0001"
                        value="<?php echo htmlspecialchars($editCPV['voucher_no'] ?? ('CPV-'.str_pad(count($_SESSION['cpv'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="cpv_date" value="<?php echo htmlspecialchars($editCPV['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Paid To</label>
                    <input type="text" name="cpv_paid_to" placeholder="Vendor / Party name"
                        value="<?php echo htmlspecialchars($editCPV['paid_to'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Account</label>
                    <select name="cpv_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCPV['account'])&&$editCPV['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="cpv_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCPV['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Payment Mode</label>
                    <select name="cpv_payment_mode" required>
                        <?php foreach(['Cash','Cheque','Bank Transfer','IBFT'] as $m){
                            $s=(isset($editCPV['payment_mode'])&&$editCPV['payment_mode']==$m)?'selected':'';
                            echo "<option $s>$m</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="cpv_description" placeholder="Reason or notes for payment..."
                        value="<?php echo htmlspecialchars($editCPV['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCPV){ ?>
                <button class="btn-primary" name="update_cpv">✏️ Update Voucher</button>
                <a href="?page=cpv" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_cpv">➕ Add Voucher</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Vouchers</div><div class="s-val"><?php echo count($_SESSION['cpv']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Paid (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['cpv'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Paid To</th><th>Account</th><th>Amount (PKR)</th><th>Payment Mode</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['cpv'])){ ?>
            <tr><td colspan="9" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['cpv']) as $r){
                $bc=match($r['payment_mode']){'Cash'=>'b-cash','Cheque'=>'b-cheque','Bank Transfer'=>'b-bank','IBFT'=>'b-ibft',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['paid_to']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td style="color:#e53935;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge <?php echo $bc; ?>"><?php echo htmlspecialchars($r['payment_mode']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_cpv=<?php echo $r['id']; ?>&page=cpv">Edit</a>
                    <a class="btn-delete" href="?delete_cpv=<?php echo $r['id']; ?>&page=cpv" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== TRANSFER VOUCHER ===== -->
    <div id="tv" class="section">
    <div class="card">
        <h2>🔁 Transfer Voucher</h2>
        <form method="POST">
            <input type="hidden" name="tv_id" value="<?php echo $editTV['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="tv">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="tv_voucher_no" placeholder="TV-0001"
                        value="<?php echo htmlspecialchars($editTV['voucher_no'] ?? ('TV-'.str_pad(count($_SESSION['tv'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="tv_date" value="<?php echo htmlspecialchars($editTV['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Transfer From (Account)</label>
                    <select name="tv_from_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editTV['from_account'])&&$editTV['from_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Transfer To (Account)</label>
                    <select name="tv_to_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editTV['to_account'])&&$editTV['to_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="tv_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editTV['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="tv_description" placeholder="Reason or notes for transfer..."
                        value="<?php echo htmlspecialchars($editTV['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editTV){ ?>
                <button class="btn-primary" name="update_tv">✏️ Update Voucher</button>
                <a href="?page=tv" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_tv">➕ Add Voucher</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Vouchers</div><div class="s-val"><?php echo count($_SESSION['tv']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Transferred (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['tv'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>From Account</th><th>To Account</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['tv'])){ ?>
            <tr><td colspan="8" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['tv']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['from_account']); ?></td>
                <td><?php echo htmlspecialchars($r['to_account']); ?></td>
                <td style="color:#1565c0;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_tv=<?php echo $r['id']; ?>&page=tv">Edit</a>
                    <a class="btn-delete" href="?delete_tv=<?php echo $r['id']; ?>&page=tv" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CHEQUE ISSUANCE TO PARTY ===== -->
    <div id="ci" class="section">
    <div class="card">
        <h2>🏦 Cheque Issuance to Party</h2>
        <form method="POST">
            <input type="hidden" name="ci_id" value="<?php echo $editCI['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="ci">
            <div class="form-grid">
                <div class="form-group">
                    <label>Cheque No</label>
                    <input type="text" name="ci_cheque_no" placeholder="e.g. 0451206"
                        value="<?php echo htmlspecialchars($editCI['cheque_no'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="ci_date" value="<?php echo htmlspecialchars($editCI['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Party Name</label>
                    <input type="text" name="ci_party_name" placeholder="Vendor / Party name"
                        value="<?php echo htmlspecialchars($editCI['party_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Account</label>
                    <select name="ci_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCI['account'])&&$editCI['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" name="ci_bank_name" placeholder="e.g. HBL, UBL, Meezan"
                        value="<?php echo htmlspecialchars($editCI['bank_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="ci_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCI['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="ci_status" required>
                        <?php foreach(['Pending','Cleared','Bounced','Cancelled'] as $st){
                            $s=(isset($editCI['status'])&&$editCI['status']==$st)?'selected':'';
                            echo "<option $s>$st</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="ci_description" placeholder="Reason or notes for cheque..."
                        value="<?php echo htmlspecialchars($editCI['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCI){ ?>
                <button class="btn-primary" name="update_ci">✏️ Update Cheque</button>
                <a href="?page=ci" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_ci">➕ Issue Cheque</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Cheques</div><div class="s-val"><?php echo count($_SESSION['ci']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Issued (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['ci'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Cheque No</th><th>Date</th><th>Party Name</th><th>Account</th><th>Bank</th><th>Amount (PKR)</th><th>Status</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['ci'])){ ?>
            <tr><td colspan="10" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['ci']) as $r){
                $sColor=match($r['status']){'Cleared'=>'background:#d4edda;color:#155724;','Pending'=>'background:#fff3cd;color:#856404;','Bounced'=>'background:#f8d7da;color:#721c24;','Cancelled'=>'background:#e2e3e5;color:#383d41;',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['cheque_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['party_name']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td><?php echo htmlspecialchars($r['bank_name']); ?></td>
                <td style="color:#e53935;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge" style="<?php echo $sColor; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_ci=<?php echo $r['id']; ?>&page=ci">Edit</a>
                    <a class="btn-delete" href="?delete_ci=<?php echo $r['id']; ?>&page=ci" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CHEQUE RECEIVED FROM PARTY ===== -->
    <div id="cr" class="section">
    <div class="card">
        <h2>📥 Cheque Received from Party</h2>
        <form method="POST">
            <input type="hidden" name="cr_id" value="<?php echo $editCR['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cr">
            <div class="form-grid">
                <div class="form-group">
                    <label>Cheque No</label>
                    <input type="text" name="cr_cheque_no" placeholder="e.g. 0998876"
                        value="<?php echo htmlspecialchars($editCR['cheque_no'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="cr_date" value="<?php echo htmlspecialchars($editCR['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Party Name</label>
                    <input type="text" name="cr_party_name" placeholder="Customer / Party name"
                        value="<?php echo htmlspecialchars($editCR['party_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Account</label>
                    <select name="cr_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCR['account'])&&$editCR['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" name="cr_bank_name" placeholder="e.g. HBL, UBL, Meezan"
                        value="<?php echo htmlspecialchars($editCR['bank_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="cr_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCR['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="cr_status" required>
                        <?php foreach(['Pending','Cleared','Bounced','Cancelled'] as $st){
                            $s=(isset($editCR['status'])&&$editCR['status']==$st)?'selected':'';
                            echo "<option $s>$st</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="cr_description" placeholder="Reason or notes for cheque..."
                        value="<?php echo htmlspecialchars($editCR['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCR){ ?>
                <button class="btn-primary" name="update_cr">✏️ Update Cheque</button>
                <a href="?page=cr" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_cr">➕ Add Cheque</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Cheques</div><div class="s-val"><?php echo count($_SESSION['cr']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Received (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['cr'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Cheque No</th><th>Date</th><th>Party Name</th><th>Account</th><th>Bank</th><th>Amount (PKR)</th><th>Status</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['cr'])){ ?>
            <tr><td colspan="10" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['cr']) as $r){
                $sColor=match($r['status']){'Cleared'=>'background:#d4edda;color:#155724;','Pending'=>'background:#fff3cd;color:#856404;','Bounced'=>'background:#f8d7da;color:#721c24;','Cancelled'=>'background:#e2e3e5;color:#383d41;',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['cheque_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['party_name']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td><?php echo htmlspecialchars($r['bank_name']); ?></td>
                <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge" style="<?php echo $sColor; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_cr=<?php echo $r['id']; ?>&page=cr">Edit</a>
                    <a class="btn-delete" href="?delete_cr=<?php echo $r['id']; ?>&page=cr" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CHEQUE DEPOSIT ===== -->
    <div id="cd" class="section">
    <div class="card">
        <h2>🏦 Cheque Deposit</h2>
        <form method="POST">
            <input type="hidden" name="cd_id" value="<?php echo $editCD['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cd">
            <div class="form-grid">
                <div class="form-group">
                    <label>Cheque No</label>
                    <input type="text" name="cd_cheque_no" placeholder="e.g. 0998876"
                        value="<?php echo htmlspecialchars($editCD['cheque_no'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="cd_date" value="<?php echo htmlspecialchars($editCD['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Received From (Party)</label>
                    <input type="text" name="cd_party_name" placeholder="Customer / Party name"
                        value="<?php echo htmlspecialchars($editCD['party_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Deposit Account</label>
                    <select name="cd_deposit_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCD['deposit_account'])&&$editCD['deposit_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" name="cd_bank_name" placeholder="e.g. HBL, UBL, Meezan"
                        value="<?php echo htmlspecialchars($editCD['bank_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="cd_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCD['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="cd_status" required>
                        <?php foreach(['Pending','Cleared','Bounced'] as $st){
                            $s=(isset($editCD['status'])&&$editCD['status']==$st)?'selected':'';
                            echo "<option $s>$st</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="cd_description" placeholder="Reason or notes for deposit..."
                        value="<?php echo htmlspecialchars($editCD['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCD){ ?>
                <button class="btn-primary" name="update_cd">✏️ Update Deposit</button>
                <a href="?page=cd" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_cd">➕ Add Deposit</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Cheques</div><div class="s-val"><?php echo count($_SESSION['cd']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Deposited (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['cd'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Cheque No</th><th>Date</th><th>Received From</th><th>Deposit Account</th><th>Bank</th><th>Amount (PKR)</th><th>Status</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['cd'])){ ?>
            <tr><td colspan="10" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['cd']) as $r){
                $sColor=match($r['status']){'Cleared'=>'background:#d4edda;color:#155724;','Pending'=>'background:#fff3cd;color:#856404;','Bounced'=>'background:#f8d7da;color:#721c24;',default=>''};
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['cheque_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['party_name']); ?></td>
                <td><?php echo htmlspecialchars($r['deposit_account']); ?></td>
                <td><?php echo htmlspecialchars($r['bank_name']); ?></td>
                <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><span class="badge" style="<?php echo $sColor; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_cd=<?php echo $r['id']; ?>&page=cd">Edit</a>
                    <a class="btn-delete" href="?delete_cd=<?php echo $r['id']; ?>&page=cd" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CASH DEPOSIT ===== -->
    <div id="cashdeposit" class="section">
    <div class="card">
        <h2>💰 Cash Deposit</h2>
        <form method="POST">
            <input type="hidden" name="csd_id" value="<?php echo $editCSD['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cashdeposit">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="csd_voucher_no" placeholder="CD-0001"
                        value="<?php echo htmlspecialchars($editCSD['voucher_no'] ?? ('CD-'.str_pad(count($_SESSION['csd'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="csd_date" value="<?php echo htmlspecialchars($editCSD['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Deposit Into (Account)</label>
                    <select name="csd_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCSD['account'])&&$editCSD['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deposited By</label>
                    <input type="text" name="csd_deposited_by" placeholder="Staff member name"
                        value="<?php echo htmlspecialchars($editCSD['deposited_by'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="csd_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCSD['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="csd_description" placeholder="Reason or notes for deposit..."
                        value="<?php echo htmlspecialchars($editCSD['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCSD){ ?>
                <button class="btn-primary" name="update_csd">✏️ Update Deposit</button>
                <a href="?page=cashdeposit" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_csd">➕ Add Deposit</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Deposits</div><div class="s-val"><?php echo count($_SESSION['csd']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Deposited (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['csd'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Account</th><th>Deposited By</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['csd'])){ ?>
            <tr><td colspan="8" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['csd']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td><?php echo htmlspecialchars($r['deposited_by']); ?></td>
                <td style="color:green;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_csd=<?php echo $r['id']; ?>&page=cashdeposit">Edit</a>
                    <a class="btn-delete" href="?delete_csd=<?php echo $r['id']; ?>&page=cashdeposit" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== CASH WITHDRAWAL ===== -->
    <div id="cashwithdraw" class="section">
    <div class="card">
        <h2>🏧 Cash Withdrawal</h2>
        <form method="POST">
            <input type="hidden" name="csw_id" value="<?php echo $editCSW['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="cashwithdraw">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="csw_voucher_no" placeholder="CW-0001"
                        value="<?php echo htmlspecialchars($editCSW['voucher_no'] ?? ('CW-'.str_pad(count($_SESSION['csw'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="csw_date" value="<?php echo htmlspecialchars($editCSW['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Withdraw From (Account)</label>
                    <select name="csw_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editCSW['account'])&&$editCSW['account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Withdrawn By</label>
                    <input type="text" name="csw_withdrawn_by" placeholder="Staff member name"
                        value="<?php echo htmlspecialchars($editCSW['withdrawn_by'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="csw_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCSW['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="csw_description" placeholder="Reason or notes for withdrawal..."
                        value="<?php echo htmlspecialchars($editCSW['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editCSW){ ?>
                <button class="btn-primary" name="update_csw">✏️ Update Withdrawal</button>
                <a href="?page=cashwithdraw" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_csw">➕ Add Withdrawal</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Withdrawals</div><div class="s-val"><?php echo count($_SESSION['csw']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Withdrawn (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['csw'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>Account</th><th>Withdrawn By</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['csw'])){ ?>
            <tr><td colspan="8" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['csw']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['account']); ?></td>
                <td><?php echo htmlspecialchars($r['withdrawn_by']); ?></td>
                <td style="color:#e53935;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_csw=<?php echo $r['id']; ?>&page=cashwithdraw">Edit</a>
                    <a class="btn-delete" href="?delete_csw=<?php echo $r['id']; ?>&page=cashwithdraw" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== IBFT ===== -->
    <div id="ibft" class="section">
    <div class="card">
        <h2>🔄 Interbank Funds Transfer (IBFT)</h2>
        <form method="POST">
            <input type="hidden" name="ibft_id" value="<?php echo $editIBFT['id'] ?? ''; ?>">
            <input type="hidden" name="page" value="ibft">
            <div class="form-grid">
                <div class="form-group">
                    <label>Voucher No</label>
                    <input type="text" name="ibft_voucher_no" placeholder="IBFT-0001"
                        value="<?php echo htmlspecialchars($editIBFT['voucher_no'] ?? ('IBFT-'.str_pad(count($_SESSION['ibft'])+1,4,'0',STR_PAD_LEFT))); ?>" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="ibft_date" value="<?php echo htmlspecialchars($editIBFT['date'] ?? date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>From Account</label>
                    <select name="ibft_from_account" required>
                        <option value="">-- Select Account --</option>
                        <?php foreach($_SESSION['coa'] as $a){
                            $s=(isset($editIBFT['from_account'])&&$editIBFT['from_account']==$a['name'])?'selected':'';
                            echo "<option value='{$a['name']}' $s>{$a['code']} - {$a['name']}</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>To Bank / Party (Beneficiary)</label>
                    <input type="text" name="ibft_to_bank" placeholder="e.g. UBL - Vendor Name"
                        value="<?php echo htmlspecialchars($editIBFT['to_bank'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Reference No</label>
                    <input type="text" name="ibft_reference_no" placeholder="e.g. IBFT20260613A"
                        value="<?php echo htmlspecialchars($editIBFT['reference_no'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Amount (PKR)</label>
                    <input type="number" name="ibft_amount" placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editIBFT['amount'] ?? ''); ?>" required>
                </div>
                <div class="form-group" style="grid-column:span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="ibft_description" placeholder="Reason or notes for transfer..."
                        value="<?php echo htmlspecialchars($editIBFT['description'] ?? ''); ?>">
                </div>
            </div>
            <?php if($editIBFT){ ?>
                <button class="btn-primary" name="update_ibft">✏️ Update IBFT</button>
                <a href="?page=ibft" class="btn-cancel">Cancel</a>
            <?php } else { ?>
                <button class="btn-primary" name="add_ibft">➕ Add IBFT</button>
            <?php } ?>
        </form>

        <hr class="divider">

        <div class="summary-row">
            <div class="s-box"><div class="s-label">Total Transfers</div><div class="s-val"><?php echo count($_SESSION['ibft']); ?></div></div>
            <div class="s-box"><div class="s-label">Total Transferred (PKR)</div><div class="s-val"><?php echo number_format(array_sum(array_column($_SESSION['ibft'],'amount')),2); ?></div></div>
        </div>

        <table>
            <tr><th>#</th><th>Voucher No</th><th>Date</th><th>From Account</th><th>To Bank / Party</th><th>Reference No</th><th>Amount (PKR)</th><th>Description</th><th>Action</th></tr>
            <?php if(empty($_SESSION['ibft'])){ ?>
            <tr><td colspan="9" style="color:#aaa;padding:20px;font-style:italic;">No records found. Add a new entry using the form above.</td></tr>
            <?php }
            $i=1; foreach(array_reverse($_SESSION['ibft']) as $r){ ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($r['date']); ?></td>
                <td><?php echo htmlspecialchars($r['from_account']); ?></td>
                <td><?php echo htmlspecialchars($r['to_bank']); ?></td>
                <td><?php echo htmlspecialchars($r['reference_no']); ?></td>
                <td style="color:#1565c0;font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                <td><?php echo htmlspecialchars($r['description'] ?: '—'); ?></td>
                <td>
                    <a class="btn-edit" href="?edit_ibft=<?php echo $r['id']; ?>&page=ibft">Edit</a>
                    <a class="btn-delete" href="?delete_ibft=<?php echo $r['id']; ?>&page=ibft" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </div>

    <!-- ===== REPORTS ===== -->
    <div id="reports" class="section">
    <div class="card">
        <h2>📑 Reports</h2>

        <div class="report-info no-print">
    

            <strong>Available Reports:</strong>
            <div class="report-list">
                <div class="report-list-item">📊 Chart of Accounts Report</div>
                <div class="report-list-item">📒 General Ledger Report</div>
                <div class="report-list-item">🧾 Voucher Report</div>
                <div class="report-list-item">🏦 Banking Transaction Report</div>
            </div>

           
        </div>

        <form method="GET" class="no-print">
            <input type="hidden" name="page" value="reports">
            <div class="form-grid">
                <div class="form-group">
                    <label>Report Type</label>
                    <select name="report_type" required>
                        <option value="">-- Select Report Type --</option>
                        <option value="coa" <?php echo $reportType=='coa'?'selected':''; ?>>Chart of Accounts Report</option>
                        <option value="ledger" <?php echo $reportType=='ledger'?'selected':''; ?>>General Ledger Report</option>
                        <option value="vouchers" <?php echo $reportType=='vouchers'?'selected':''; ?>>Voucher Report</option>
                        <option value="banking" <?php echo $reportType=='banking'?'selected':''; ?>>Banking Transaction Report</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date From</label>
                    <input type="date" name="report_from" value="<?php echo htmlspecialchars($reportFrom); ?>">
                </div>
                <div class="form-group">
                    <label>Date To</label>
                    <input type="date" name="report_to" value="<?php echo htmlspecialchars($reportTo); ?>">
                </div>
            </div>
            <button class="btn-primary" name="generate_report">📑 Generate Report</button>
            <?php if($reportGenerated){ ?>
                <a href="?page=reports" class="btn-cancel">✖ Clear</a>
            <?php } ?>
        </form>

        <?php if($reportGenerated){ ?>
        <div class="report-output">

            <div class="report-title">
                <?php
                $reportTitles = [
                    'coa'      => 'Chart of Accounts Report',
                    'ledger'   => 'General Ledger Report',
                    'vouchers' => 'Voucher Report',
                    'banking'  => 'Banking Transaction Report'
                ];
                echo htmlspecialchars($reportTitles[$reportType] ?? 'Report');
                ?>
            </div>
            <div class="report-meta">
                Generated on <?php echo date('Y-m-d H:i'); ?>
                <?php if($reportFrom || $reportTo){ ?>
                    | Period: <?php echo htmlspecialchars($reportFrom ?: 'Start'); ?> to <?php echo htmlspecialchars($reportTo ?: 'Today'); ?>
                <?php } ?>
            </div>

            <?php if($reportType=='coa'){ ?>
                <table>
                    <tr><th>ID</th><th>Code</th><th>Account Name</th><th>Type</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="4" style="color:#aaa;padding:20px;font-style:italic;">No records found.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo $r['id']; ?></td>
                        <td><?php echo htmlspecialchars($r['code']); ?></td>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                    </tr>
                    <?php } ?>
                </table>

            <?php } elseif($reportType=='ledger'){ ?>
                <table>
                    <tr><th>ID</th><th>Code</th><th>Account Name</th><th>Debit (PKR)</th><th>Credit (PKR)</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="5" style="color:#aaa;padding:20px;font-style:italic;">No records found.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo $r['id']; ?></td>
                        <td><?php echo htmlspecialchars($r['code']); ?></td>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td style="color:green;font-weight:bold;"><?php echo number_format($r['debit'],2); ?></td>
                        <td style="color:#e53935;font-weight:bold;"><?php echo number_format($r['credit'],2); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($reportRows)){ ?>
                    <tr>
                        <td colspan="3" style="text-align:right;font-weight:bold;">Total</td>
                        <td style="color:green;font-weight:bold;"><?php echo number_format(array_sum(array_column($reportRows,'debit')),2); ?></td>
                        <td style="color:#e53935;font-weight:bold;"><?php echo number_format(array_sum(array_column($reportRows,'credit')),2); ?></td>
                    </tr>
                    <?php } ?>
                </table>

            <?php } elseif($reportType=='vouchers'){ ?>
                <table>
                    <tr><th>Voucher Type</th><th>Voucher No</th><th>Date</th><th>Party / Account</th><th>Account</th><th>Nature</th><th>Amount (PKR)</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="7" style="color:#aaa;padding:20px;font-style:italic;">No records found for the selected period.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                        <td><strong><?php echo htmlspecialchars($r['voucher_no']); ?></strong></td>
                        <td><?php echo htmlspecialchars($r['date']); ?></td>
                        <td><?php echo htmlspecialchars($r['party']); ?></td>
                        <td><?php echo htmlspecialchars($r['account']); ?></td>
                        <td><?php echo htmlspecialchars($r['nature']); ?></td>
                        <td style="font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($reportRows)){ ?>
                    <tr>
                        <td colspan="6" style="text-align:right;font-weight:bold;">Total</td>
                        <td style="font-weight:bold;">PKR <?php echo number_format(array_sum(array_column($reportRows,'amount')),2); ?></td>
                    </tr>
                    <?php } ?>
                </table>

            <?php } elseif($reportType=='banking'){ ?>
                <table>
                    <tr><th>Transaction Type</th><th>Reference No</th><th>Date</th><th>Party / Beneficiary</th><th>Bank / Account</th><th>Amount (PKR)</th><th>Status</th></tr>
                    <?php if(empty($reportRows)){ ?>
                    <tr><td colspan="7" style="color:#aaa;padding:20px;font-style:italic;">No records found for the selected period.</td></tr>
                    <?php }
                    foreach($reportRows as $r){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                        <td><strong><?php echo htmlspecialchars($r['ref_no']); ?></strong></td>
                        <td><?php echo htmlspecialchars($r['date']); ?></td>
                        <td><?php echo htmlspecialchars($r['party']); ?></td>
                        <td><?php echo htmlspecialchars($r['bank']); ?></td>
                        <td style="font-weight:bold;">PKR <?php echo number_format($r['amount'],2); ?></td>
                        <td><?php echo htmlspecialchars($r['status']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($reportRows)){ ?>
                    <tr>
                        <td colspan="5" style="text-align:right;font-weight:bold;">Total</td>
                        <td style="font-weight:bold;">PKR <?php echo number_format(array_sum(array_column($reportRows,'amount')),2); ?></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <div class="no-print" style="margin-top:18px;">
                <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
            </div>
        </div>
        <?php } ?>

    </div>
    </div>

</div>

<script>
function showPage(page) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
    var sec = document.getElementById(page);
    var nav = document.getElementById('nav-' + page);
    if(sec) sec.classList.add('active');
    if(nav) nav.classList.add('active');
}
window.onload = function(){
    showPage('<?php echo $activePage; ?>');
}
</script>

</body>
</html>