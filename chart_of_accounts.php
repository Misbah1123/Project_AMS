<?php
session_start();

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

/* ADD */
if(isset($_POST['add']))
{
$_SESSION['coa'][] = [
"id"=>time(),
"code"=>$_POST['code'],
"name"=>$_POST['name'],
"type"=>$_POST['type']
];
}

/* DELETE */
if(isset($_GET['delete']))
{
foreach($_SESSION['coa'] as $key=>$row)
{
if($row['id']==$_GET['delete'])
{
unset($_SESSION['coa'][$key]);
}
}
}

/* EDIT */
$edit=null;

if(isset($_GET['edit']))
{
foreach($_SESSION['coa'] as $row)
{
if($row['id']==$_GET['edit'])
{
$edit=$row;
}
}
}

if(isset($_POST['update']))
{
foreach($_SESSION['coa'] as &$row)
{
if($row['id']==$_POST['id'])
{
$row['code']=$_POST['code'];
$row['name']=$_POST['name'];
$row['type']=$_POST['type'];
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Chart of Accounts</title>

<style>

body{
background:#9ad9ce;
font-family:Arial;
padding:20px;
}

.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px #ccc;
}

h2{
margin-bottom:20px;
}

input,select{
padding:8px;
margin-right:5px;
}

.add-btn{
background:#3f9d92;
color:white;
border:none;
padding:8px 15px;
border-radius:5px;
cursor:pointer;
}

.edit-btn{
background:blue;
color:white;
padding:5px 10px;
text-decoration:none;
border-radius:5px;
}

.delete-btn{
background:red;
color:white;
padding:5px 10px;
text-decoration:none;
border-radius:5px;
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

th{
background:#3f9d92;
color:white;
padding:10px;
}

td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

</style>
</head>

<body>
<div id="coa" class="section active">
<div class="card">

<h2>📊 Chart of Accounts</h2>

<form method="POST">

<input type="hidden" name="id"
value="<?php echo $edit['id'] ?? ''; ?>">

<input type="text"
name="code"
placeholder="Code"
value="<?php echo $edit['code'] ?? ''; ?>"
required>

<input type="text"
name="name"
placeholder="Account Name"
value="<?php echo $edit['name'] ?? ''; ?>"
required>

<select name="type">

<option>Asset</option>
<option>Liability</option>
<option>Income</option>
<option>Expense</option>

</select>

<?php if($edit){ ?>

<button class="add-btn" name="update">
Update
</button>

<?php } else { ?>

<button class="add-btn" name="add">
Add
</button>

<?php } ?>

</form>

<table>

<tr>
<th>ID</th>
<th>Code</th>
<th>Name</th>
<th>Type</th>
<th>Action</th>
</tr>

<?php foreach($_SESSION['coa'] as $row){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['code']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['type']; ?></td>

<td>

<a class="edit-btn"
href="?edit=<?php echo $row['id']; ?>">
Edit
</a>

<a class="delete-btn"
href="?delete=<?php echo $row['id']; ?>">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>
</div>
</div>

</body>
</html>