<?php
session_start();

/* =========================
   INIT DATA
========================= */
if (!isset($_SESSION['coa'])) {
    $_SESSION['coa'] = [
        ["id"=>1,"code"=>"1001","name"=>"Cash","type"=>"Asset"],
        ["id"=>2,"code"=>"1002","name"=>"Bank","type"=>"Asset"]
    ];
}

if (!isset($_SESSION['ledger'])) {
    $_SESSION['ledger'] = [
        ["id"=>1,"account"=>"Cash","type"=>"Asset"],
        ["id"=>2,"account"=>"Sales","type"=>"Income"]
    ];
}

/* =========================
   COA CRUD
========================= */
if (isset($_POST['add_coa'])) {
    $_SESSION['coa'][] = [
        "id"=>rand(100,999),
        "code"=>$_POST['code'],
        "name"=>$_POST['name'],
        "type"=>$_POST['type']
    ];
}

if (isset($_GET['delete_coa'])) {
    foreach($_SESSION['coa'] as $k=>$v){
        if($v['id']==$_GET['delete_coa']) unset($_SESSION['coa'][$k]);
    }
}

/* COA EDIT */
$edit_coa = null;
if (isset($_GET['edit_coa'])) {
    foreach($_SESSION['coa'] as $c){
        if($c['id']==$_GET['edit_coa']) $edit_coa=$c;
    }
}

if (isset($_POST['update_coa'])) {
    foreach($_SESSION['coa'] as &$c){
        if($c['id']==$_POST['id']){
            $c['code']=$_POST['code'];
            $c['name']=$_POST['name'];
            $c['type']=$_POST['type'];
        }
    }
}

/* =========================
   LEDGER CRUD
========================= */
if (isset($_POST['add_ledger'])) {
    $_SESSION['ledger'][] = [
        "id"=>rand(100,999),
        "account"=>$_POST['account'],
        "type"=>$_POST['type']
    ];
}

if (isset($_GET['delete_ledger'])) {
    foreach($_SESSION['ledger'] as $k=>$v){
        if($v['id']==$_GET['delete_ledger']) unset($_SESSION['ledger'][$k]);
    }
}

/* LEDGER EDIT */
$edit_ledger = null;
if (isset($_GET['edit_ledger'])) {
    foreach($_SESSION['ledger'] as $l){
        if($l['id']==$_GET['edit_ledger']) $edit_ledger=$l;
    }
}

if (isset($_POST['update_ledger'])) {
    foreach($_SESSION['ledger'] as &$l){
        if($l['id']==$_POST['id']){
            $l['account']=$_POST['account'];
            $l['type']=$_POST['type'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manager Dashboard</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial;}
body{display:flex;height:100vh;background:#e6f2ef;}

/* SIDEBAR */
.sidebar{
width:260px;
background:#3f9d92;
color:white;
padding:15px;
}

.sidebar a{
display:block;
padding:12px;
color:white;
text-decoration:none;
cursor:pointer;
}

.sidebar a:hover{background:#2f7f76;}

/* MAIN */
.main{flex:1;padding:20px;}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.logout{
background:red;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;
}

/* CARD */
.card{
background:white;
padding:20px;
border-radius:10px;
margin-bottom:20px;
}

.section{display:none;}
.active{display:block;}

table{width:100%;border-collapse:collapse;margin-top:10px;}
th{background:#3f9d92;color:white;padding:10px;}
td{padding:10px;border:1px solid #ddd;text-align:center;}

button{padding:6px 10px;background:#3f9d92;color:white;border:none;cursor:pointer;}

a.action{
padding:5px 8px;
text-decoration:none;
color:white;
border-radius:4px;
}

.edit{background:blue;}
.delete{background:red;}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<h2>MANAGER PANEL</h2>

<a onclick="show('coa')">📊 Chart of Accounts</a>
<a onclick="show('ledger')">📒 General Ledger</a>
<a onclick="show('crv')">💵 Cash Receipt Voucher</a>
<a onclick="show('cpv')">💸 Cash Payment Voucher</a>
<a onclick="show('tv')">🔁 Transfer Voucher</a>
<a onclick="show('ci')">🏦 Cheque Issuance</a>
<a onclick="show('cr')">📥 Cheque Received</a>
<a onclick="show('cd')">🏦 Cheque Deposit</a>
<a onclick="show('cash_deposit')">💰 Cash Deposit</a>
<a onclick="show('cash_withdraw')">🏧 Cash Withdrawal</a>
<a onclick="show('ibft')">🔄 IBFT</a>
<a href="login.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="header">
<h1>Welcome fiza123</h1>
<a class="logout" href="login.php">Logout</a>
</div>

<!-- ================= COA ================= -->
<div id="coa" class="section active">
<div class="card">

<h2>📊 Chart of Accounts</h2>

<form method="POST">
<input type="hidden" name="id" value="<?= $edit_coa['id'] ?? '' ?>">
<input name="code" placeholder="Code" value="<?= $edit_coa['code'] ?? '' ?>" required>
<input name="name" placeholder="Name" value="<?= $edit_coa['name'] ?? '' ?>" required>
<input name="type" placeholder="Type" value="<?= $edit_coa['type'] ?? '' ?>" required>

<?php if($edit_coa): ?>
<button name="update_coa">Update</button>
<?php else: ?>
<button name="add_coa">Add</button>
<?php endif; ?>
</form>

<table>
<tr>
<th>ID</th><th>Code</th><th>Name</th><th>Type</th><th>Action</th>
</tr>

<div id="coa" class="section active">

<div class="card">

<h2>📊 Chart of Accounts</h2>

<table width="100%" border="1" cellspacing="0">

<tr style="background:#3f9d92;color:white;">
<th>ID</th>
<th>Account Name</th>
<th>Type</th>
<th>Balance</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php foreach($_SESSION['coa'] as $row){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['type']; ?></td>
<td><?php echo $row['balance']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>
<a href="?edit_coa=<?php echo $row['id']; ?>">Edit</a>
<a href="?delete_coa=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<!-- ================= LEDGER ================= -->
<div id="ledger" class="section">
<div class="card">

<h2>📒 General Ledger</h2>

<form method="POST">
<input type="hidden" name="id" value="<?= $edit_ledger['id'] ?? '' ?>">
<input name="account" placeholder="Account" value="<?= $edit_ledger['account'] ?? '' ?>" required>
<input name="type" placeholder="Type" value="<?= $edit_ledger['type'] ?? '' ?>" required>

<?php if($edit_ledger): ?>
<button name="update_ledger">Update</button>
<?php else: ?>
<button name="add_ledger">Add</button>
<?php endif; ?>
</form>

<table>
<tr>
<th>ID</th><th>Account</th><th>Type</th><th>Action</th>
</tr>

<?php foreach($_SESSION['ledger'] as $l): ?>
<tr>
<td><?= $l['id'] ?></td>
<td><?= $l['account'] ?></td>
<td><?= $l['type'] ?></td>
<td>
<a class="action edit" href="?edit_ledger=<?= $l['id'] ?>">Edit</button>
<a class="action delete" href="?delete_ledger=<?= $l['id'] ?>">Delete</button>
</td>
</tr>
<?php endforeach; ?>
</table>

</div>
</div>

<!-- PLACEHOLDERS -->
<div id="crv" class="section"><div class="card"><h2>💵 Cash Receipt Voucher</h2></div></div>
<div id="cpv" class="section"><div class="card"><h2>💸 Cash Payment Voucher</h2></div></div>
<div id="tv" class="section"><div class="card"><h2>🔁 Transfer Voucher</h2></div></div>
<div id="ibft" class="section"><div class="card"><h2>🔄 IBFT</h2></div></div>

</div>

<script>
function show(id){
document.querySelectorAll('.section').forEach(s=>s.classList.remove('active'));
document.getElementById(id).classList.add('active');
}
</script>

</body>
</html>