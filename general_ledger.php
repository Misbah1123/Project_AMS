<!-- GENERAL LEDGER -->
<div id="ledger" class="section">

<div class="card">

<h2>📒 General Ledger Accounts</h2>

<?php
session_start();

/* INIT */
if(!isset($_SESSION['ledger']))
{
$_SESSION['ledger'] = [
["id"=>1,"code"=>"GL001","name"=>"Cash Account","debit"=>"5000","credit"=>"0"],
["id"=>2,"code"=>"GL002","name"=>"Bank Account","debit"=>"10000","credit"=>"0"],
["id"=>3,"code"=>"GL003","name"=>"Sales Revenue","debit"=>"0","credit"=>"15000"],
["id"=>4,"code"=>"GL004","name"=>"Office Expense","debit"=>"3000","credit"=>"0"]
];
}

/* ADD */
if(isset($_POST['add_ledger']))
{
$_SESSION['ledger'][] = [
"id"=>time(),
"code"=>$_POST['code'],
"name"=>$_POST['name'],
"debit"=>$_POST['debit'],
"credit"=>$_POST['credit']
];
}

/* DELETE */
if(isset($_GET['delete_ledger']))
{
foreach($_SESSION['ledger'] as $key=>$row)
{
if($row['id']==$_GET['delete_ledger'])
{
unset($_SESSION['ledger'][$key]);
}
}
}

/* EDIT */
$editLedger = null;

if(isset($_GET['edit_ledger']))
{
foreach($_SESSION['ledger'] as $row)
{
if($row['id']==$_GET['edit_ledger'])
{
$editLedger = $row;
}
}
}

/* UPDATE */
if(isset($_POST['update_ledger']))
{
foreach($_SESSION['ledger'] as &$row)
{
if($row['id']==$_POST['id'])
{
$row['code']=$_POST['code'];
$row['name']=$_POST['name'];
$row['debit']=$_POST['debit'];
$row['credit']=$_POST['credit'];
}
}
}
?>

<!-- FORM -->
<form method="POST">

<input type="hidden" name="id"
value="<?php echo $editLedger['id'] ?? ''; ?>">

<input type="text" name="code" placeholder="Ledger Code"
value="<?php echo $editLedger['code'] ?? ''; ?>" required>

<input type="text" name="name" placeholder="Account Name"
value="<?php echo $editLedger['name'] ?? ''; ?>" required>

<input type="number" name="debit" placeholder="Debit"
value="<?php echo $editLedger['debit'] ?? ''; ?>" required>

<input type="number" name="credit" placeholder="Credit"
value="<?php echo $editLedger['credit'] ?? ''; ?>" required>

<br><br>

<?php if($editLedger){ ?>

<button class="add-btn" name="update_ledger">Update</button>

<?php } else { ?>

<button class="add-btn" name="add_ledger">Add</button>

<?php } ?>

</form>

<br>

<!-- TABLE -->
<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Code</th>
<th>Name</th>
<th>Debit</th>
<th>Credit</th>
<th>Action</th>
</tr>

<?php foreach($_SESSION['ledger'] as $row){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['code']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['debit']; ?></td>
<td><?php echo $row['credit']; ?></td>

<td>
<a href="?edit_ledger=<?php echo $row['id']; ?>">Edit</a> |
<a href="?delete_ledger=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>

<?php } ?>

</table>

</div>
</div>