<?php
session_start();

/* ===================== CASH RECEIPT VOUCHER CRUD ===================== */

if(!isset($_SESSION['crv'])) $_SESSION['crv'] = [];

/* AUTO VOUCHER NUMBER */
function generateVoucherNo() {
    $count = count($_SESSION['crv']) + 1;
    return 'CRV-' . str_pad($count, 4, '0', STR_PAD_LEFT);
}

/* ADD */
if(isset($_POST['add_crv']))
{
    $_SESSION['crv'][] = [
        "id"            => time(),
        "voucher_no"    => $_POST['crv_voucher_no'],
        "date"          => $_POST['crv_date'],
        "received_from" => $_POST['crv_received_from'],
        "account"       => $_POST['crv_account'],
        "amount"        => $_POST['crv_amount'],
        "description"   => $_POST['crv_description'],
        "payment_mode"  => $_POST['crv_payment_mode']
    ];
    header("Location: cash_receipt_voucher.php?msg=added");
    exit;
}

/* DELETE */
if(isset($_GET['delete_crv']))
{
    foreach($_SESSION['crv'] as $key => $row)
        if($row['id'] == $_GET['delete_crv'])
            unset($_SESSION['crv'][$key]);
    header("Location: cash_receipt_voucher.php?msg=deleted");
    exit;
}

/* EDIT */
$editCRV = null;
if(isset($_GET['edit_crv']))
    foreach($_SESSION['crv'] as $row)
        if($row['id'] == $_GET['edit_crv'])
            $editCRV = $row;

/* UPDATE */
if(isset($_POST['update_crv']))
{
    foreach($_SESSION['crv'] as &$row)
        if($row['id'] == $_POST['crv_id'])
        {
            $row['voucher_no']    = $_POST['crv_voucher_no'];
            $row['date']          = $_POST['crv_date'];
            $row['received_from'] = $_POST['crv_received_from'];
            $row['account']       = $_POST['crv_account'];
            $row['amount']        = $_POST['crv_amount'];
            $row['description']   = $_POST['crv_description'];
            $row['payment_mode']  = $_POST['crv_payment_mode'];
        }
    header("Location: cash_receipt_voucher.php?msg=updated");
    exit;
}

/* SUMMARY CALCULATIONS */
$totalVouchers = count($_SESSION['crv']);
$totalAmount   = array_sum(array_column($_SESSION['crv'], 'amount'));

/* COA for dropdown - agar session nahi to default */
if(!isset($_SESSION['coa']))
{
    $_SESSION['coa'] = [
        ["id"=>1,"code"=>"1001","name"=>"Cash Account","type"=>"Asset"],
        ["id"=>2,"code"=>"1002","name"=>"Bank Account","type"=>"Asset"],
        ["id"=>3,"code"=>"4001","name"=>"Sales Revenue","type"=>"Income"],
        ["id"=>4,"code"=>"5001","name"=>"Office Expense","type"=>"Expense"],
        ["id"=>5,"code"=>"2001","name"=>"Accounts Payable","type"=>"Liability"]
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Cash Receipt Voucher - AMS</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:Arial,sans-serif; }
body { display:flex; height:100vh; background:#9ad9ce; }

/* SIDEBAR */
.sidebar { width:250px; background:#3f9d92; color:white; padding-top:20px; overflow-y:auto; flex-shrink:0; }
.logo { text-align:center; font-size:20px; font-weight:bold; margin-bottom:25px; padding:0 10px; }
.sidebar a { display:block; padding:13px 18px; color:white; text-decoration:none; font-size:14px; }
.sidebar a:hover, .sidebar a.active { background:#2f7f76; }

/* MAIN */
.main { flex:1; padding:20px; overflow:auto; }

/* HEADER */
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.header h1 { color:#1f4f59; font-size:22px; }
.back-btn { background:#3f9d92; color:white; padding:9px 16px; border-radius:6px; text-decoration:none; font-size:14px; }
.back-btn:hover { background:#2f7f76; }

/* CARD */
.card { background:white; padding:25px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.15); }

/* ALERT */
.alert { padding:10px 15px; border-radius:6px; margin-bottom:15px; font-size:14px; }
.alert.success { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }

/* FORM */
.form-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); gap:15px; margin-bottom:20px; }
.form-group { display:flex; flex-direction:column; }
.form-group label { font-size:13px; color:#444; margin-bottom:5px; font-weight:bold; }
.form-group input,
.form-group select { padding:9px 10px; border:1px solid #ccc; border-radius:5px; font-size:14px; }
.form-group input:focus,
.form-group select:focus { outline:none; border-color:#3f9d92; }
.form-actions { display:flex; gap:10px; margin-top:5px; }
.btn-add    { background:#3f9d92; color:white; border:none; padding:10px 22px; border-radius:6px; cursor:pointer; font-size:14px; }
.btn-add:hover { background:#2f7f76; }
.btn-cancel { background:#888; color:white; padding:10px 18px; border-radius:6px; text-decoration:none; font-size:14px; }
.btn-cancel:hover { background:#666; }

/* SUMMARY BOXES */
.summary-row { display:flex; gap:15px; margin:22px 0 10px; flex-wrap:wrap; }
.s-box { background:#e8f8f5; border-radius:8px; padding:14px 22px; text-align:center; min-width:160px; }
.s-box .s-label { font-size:12px; color:#555; margin-bottom:4px; }
.s-box .s-val   { font-size:24px; font-weight:bold; color:#1f4f59; }

/* TABLE */
table { width:100%; border-collapse:collapse; margin-top:10px; }
th { background:#3f9d92; color:white; padding:11px 10px; text-align:center; font-size:13px; }
td { border:1px solid #ddd; padding:10px; text-align:center; font-size:13px; }
tr:nth-child(even) { background:#f7f7f7; }
tr:hover { background:#eef9f7; }
.badge { padding:4px 10px; border-radius:20px; font-size:12px; font-weight:bold; }
.badge-cash     { background:#d4edda; color:#155724; }
.badge-cheque   { background:#fff3cd; color:#856404; }
.badge-bank     { background:#cce5ff; color:#004085; }
.badge-ibft     { background:#f3e5ff; color:#5a007a; }

.edit-btn   { background:#007bff; color:white; padding:5px 12px; text-decoration:none; border-radius:5px; font-size:12px; margin-right:3px; }
.delete-btn { background:#dc3545; color:white; padding:5px 12px; text-decoration:none; border-radius:5px; font-size:12px; }
.edit-btn:hover   { background:#0056b3; }
.delete-btn:hover { background:#a71d2a; }

.empty-row td { color:#aaa; padding:25px; font-style:italic; }

h2 { color:#1f4f59; margin-bottom:20px; font-size:20px; }
.section-divider { border:none; border-top:1px solid #e0e0e0; margin:20px 0; }
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">⚙️ AMS PANEL</div>
    <a href="manager_dashboard.php">🏠 Dashboard</a>
    <a href="chart_of_accounts.php">📊 Chart of Accounts</a>
    <a href="general_ledger.php">📒 General Ledger</a>
    <a href="cash_receipt_voucher.php" class="active">💵 Cash Receipt Voucher</a>
    <a href="cash_payment_voucher.php">💸 Cash Payment Voucher</a>
    <a href="transfer_voucher.php">🔁 Transfer Voucher</a>
    <a href="cheque_issuance.php">🏦 Cheque Issuance to Party</a>
    <a href="cheque_received.php">📥 Cheque Received from Party</a>
    <a href="cheque_deposit.php">🏦 Cheque Deposit</a>
    <a href="cash_deposit.php">💰 Cash Deposit</a>
    <a href="cash_withdrawal.php">🏧 Cash Withdrawal</a>
    <a href="ibft.php">🔄 IBFT</a>
    <a href="login.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <h1>💵 Cash Receipt Voucher</h1>
        <a href="manager_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
    </div>

    <!-- SUCCESS ALERT -->
    <?php if(isset($_GET['msg'])){ ?>
    <div class="alert success">
        <?php
        if($_GET['msg']=='added')   echo '✅ Voucher successfully add ho gaya!';
        if($_GET['msg']=='updated') echo '✅ Voucher successfully update ho gaya!';
        if($_GET['msg']=='deleted') echo '🗑️ Voucher delete ho gaya!';
        ?>
    </div>
    <?php } ?>

    <div class="card">

        <h2><?php echo $editCRV ? '✏️ Voucher Edit Karen' : '➕ Naya Voucher Add Karen'; ?></h2>

        <form method="POST">
            <input type="hidden" name="crv_id" value="<?php echo $editCRV['id'] ?? ''; ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Voucher No *</label>
                    <input type="text" name="crv_voucher_no"
                        placeholder="e.g. CRV-0001"
                        value="<?php echo htmlspecialchars($editCRV['voucher_no'] ?? generateVoucherNo()); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Date *</label>
                    <input type="date" name="crv_date"
                        value="<?php echo htmlspecialchars($editCRV['date'] ?? date('Y-m-d')); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Received From *</label>
                    <input type="text" name="crv_received_from"
                        placeholder="Customer / Party ka naam"
                        value="<?php echo htmlspecialchars($editCRV['received_from'] ?? ''); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Account *</label>
                    <select name="crv_account" required>
                        <option value="">-- Account Select Karen --</option>
                        <?php foreach($_SESSION['coa'] as $acc){
                            $sel = (isset($editCRV['account']) && $editCRV['account']==$acc['name']) ? 'selected' : '';
                            echo "<option value='{$acc['name']}' $sel>{$acc['code']} - {$acc['name']}</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Amount (PKR) *</label>
                    <input type="number" name="crv_amount"
                        placeholder="0.00" min="1" step="0.01"
                        value="<?php echo htmlspecialchars($editCRV['amount'] ?? ''); ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Payment Mode *</label>
                    <select name="crv_payment_mode" required>
                        <?php
                        $modes = ['Cash','Cheque','Bank Transfer','IBFT'];
                        foreach($modes as $m){
                            $sel = (isset($editCRV['payment_mode']) && $editCRV['payment_mode']==$m) ? 'selected' : '';
                            echo "<option $sel>$m</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>Description / Narration</label>
                    <input type="text" name="crv_description"
                        placeholder="Kisi bhi tarah ki notes ya wajah..."
                        value="<?php echo htmlspecialchars($editCRV['description'] ?? ''); ?>">
                </div>

            </div>

            <div class="form-actions">
                <?php if($editCRV){ ?>
                    <button class="btn-add" name="update_crv">✏️ Update Voucher</button>
                    <a href="cash_receipt_voucher.php" class="btn-cancel">✖ Cancel</a>
                <?php } else { ?>
                    <button class="btn-add" name="add_crv">➕ Add Voucher</button>
                <?php } ?>
            </div>

        </form>

        <hr class="section-divider">

        <!-- SUMMARY -->
        <div class="summary-row">
            <div class="s-box">
                <div class="s-label">📋 Total Vouchers</div>
                <div class="s-val"><?php echo $totalVouchers; ?></div>
            </div>
            <div class="s-box">
                <div class="s-label">💰 Total Received (PKR)</div>
                <div class="s-val"><?php echo number_format($totalAmount, 2); ?></div>
            </div>
        </div>

        <!-- TABLE -->
        <table>
            <tr>
                <th>#</th>
                <th>Voucher No</th>
                <th>Date</th>
                <th>Received From</th>
                <th>Account</th>
                <th>Amount (PKR)</th>
                <th>Payment Mode</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            <?php if(empty($_SESSION['crv'])){ ?>
            <tr class="empty-row">
                <td colspan="9">Abhi koi record nahi. Upar form se voucher add karein.</td>
            </tr>
            <?php } ?>

            <?php
            $i = 1;
            foreach(array_reverse($_SESSION['crv']) as $row){
                $modeClass = match($row['payment_mode']) {
                    'Cash'          => 'badge-cash',
                    'Cheque'        => 'badge-cheque',
                    'Bank Transfer' => 'badge-bank',
                    'IBFT'          => 'badge-ibft',
                    default         => ''
                };
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><strong><?php echo htmlspecialchars($row['voucher_no']); ?></strong></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['received_from']); ?></td>
                <td><?php echo htmlspecialchars($row['account']); ?></td>
                <td style="color:green; font-weight:bold;">
                    PKR <?php echo number_format($row['amount'], 2); ?>
                </td>
                <td>
                    <span class="badge <?php echo $modeClass; ?>">
                        <?php echo htmlspecialchars($row['payment_mode']); ?>
                    </span>
                </td>
                <td><?php echo htmlspecialchars($row['description'] ?: '—'); ?></td>
                <td>
                    <a class="edit-btn"
                        href="cash_receipt_voucher.php?edit_crv=<?php echo $row['id']; ?>">
                        ✏️ Edit
                    </a>
                    <a class="delete-btn"
                        href="cash_receipt_voucher.php?delete_crv=<?php echo $row['id']; ?>"
                        onclick="return confirm('Yeh voucher delete karna chahti hain?')">
                        🗑️ Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
</div>

</body>
</html>