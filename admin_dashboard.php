<?php
session_start();

/* LOGOUT */
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

/* INIT DATA */
if (!isset($_SESSION['managers'])) {
    $_SESSION['managers'] = [
        ["id"=>1, "name"=>"Fiza Khan", "username"=>"fiza", "email"=>"fiza@gmail.com", "status"=>"Active"],
        ["id"=>2, "name"=>"Sana Ali", "username"=>"sana", "email"=>"sana@gmail.com", "status"=>"Active"],
        ["id"=>3, "name"=>"Hina Noor", "username"=>"hina", "email"=>"hina@gmail.com", "status"=>"Active"],
        ["id"=>4, "name"=>"Ayesha", "username"=>"ayesha", "email"=>"ayesha@gmail.com", "status"=>"Active"]
    ];
}

/* DELETE */
if (isset($_GET['delete'])) {
    foreach ($_SESSION['managers'] as $key => $m) {
        if ($m['id'] == $_GET['delete']) {
            unset($_SESSION['managers'][$key]);
        }
    }
}

/* ADD */
if (isset($_POST['add'])) {
    $_SESSION['managers'][] = [
        "id" => rand(100,999),
        "name" => $_POST['name'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "status" => "Active"
    ];
}

/* EDIT */
if (isset($_POST['update'])) {
    foreach ($_SESSION['managers'] as &$m) {
        if ($m['id'] == $_POST['id']) {
            $m['name'] = $_POST['name'];
            $m['username'] = $_POST['username'];
            $m['email'] = $_POST['email'];
        }
    }
}

$edit = null;
if (isset($_GET['edit'])) {
    foreach ($_SESSION['managers'] as $m) {
        if ($m['id'] == $_GET['edit']) {
            $edit = $m;
        }
    }
}

/* ACTIVE PAGE */
$activePage = 'Dashboard';
if(isset($_GET['edit']))     $activePage = 'manager';
if(isset($_GET['delete']))   $activePage = 'manager';
if(isset($_POST['add']))     $activePage = 'manager';
if(isset($_POST['update']))  $activePage = 'manager';
?>

<!DOCTYPE html>
<html>
<head>
<title>AMS Admin Panel</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
display:flex;
height:100vh;
background:#9ad9ce;
}

.sidebar{
width:220px;
background:#3f9d92;
color:white;
padding-top:20px;
}

.logo{
text-align:center;
font-size:22px;
font-weight:bold;
margin-bottom:25px;
}

.sidebar a{
display:block;
padding:14px;
color:white;
text-decoration:none;
cursor:pointer;
}

.sidebar a:hover{
background:#2f7f76;
}

.main{
flex:1;
padding:20px;
overflow:auto;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.header h1{
color:#1f4f59;
}

.logout-btn{
background:red;
color:white;
padding:10px 15px;
border-radius:5px;
text-decoration:none;
}

.card{
background:white;
padding:20px;
border-radius:10px;
}

.add-btn{
background:#3f9d92;
color:white;
border:none;
padding:10px;
border-radius:5px;
cursor:pointer;
}

.edit-btn{
background:blue;
color:white;
padding:5px 10px;
border-radius:5px;
text-decoration:none;
}

.delete-btn{
background:red;
color:white;
padding:5px 10px;
border-radius:5px;
text-decoration:none;
}

table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

th{
background:#3f9d92;
color:white;
padding:10px;
}

td{
padding:10px;
border:1px solid #ddd;
text-align:center;
}

.section{
display:none;
}

.section.active{
display:block;
}

.boxes{
display:flex;
gap:15px;
flex-wrap:wrap;
margin-top:15px;
}

.box{
flex:1;
min-width:160px;
background:#3f9d92;
color:white;
padding:20px;
border-radius:10px;
text-align:center;
cursor:pointer;
}

.box:hover{
background:#2f7f76;
}

.box p{
font-size:28px;
font-weight:bold;
margin-top:8px;
}

h2{
color:#1f4f59;
margin-bottom:15px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<div class="logo">ADMIN PANEL</div>
<a onclick="showPage('Dashboard')">🏠 Dashboard</a>
<a onclick="showPage('manager')">👥 Manage Managers</a>
<a onclick="showPage('reports')">📊 Reports</a>
<a onclick="showPage('settings')">⚙ Settings</a>
<a href="?logout=1">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="header">
<h1>Welcome misbah123👋</h1>
<a href="?logout=1" class="logout-btn">Logout</a>
</div>

<!-- DASHBOARD -->
<div id="Dashboard" class="section">
<div class="card">
<h2>🏠 Admin Dashboard</h2>

<div class="boxes">

<div class="box" onclick="showPage('manager')">
<h3>👥 Total Managers</h3>
<p><?php echo count($_SESSION['managers']); ?></p>
</div>

<div class="box" onclick="showPage('manager')">
<h3>✅ Active Users</h3>
<p><?php echo count(array_filter($_SESSION['managers'], fn($m) => $m['status'] == 'Active')); ?></p>
</div>

<div class="box" onclick="showPage('reports')">
<h3>📊 Reports</h3>
<p>1</p>
</div>

<div class="box" onclick="showPage('settings')">
<h3>⚙ Settings</h3>
<p>1</p>
</div>

</div>

<br><br>

<h2>👥 Registered Managers</h2>
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Username</th>
<th>Email</th>
<th>Status</th>
</tr>
<?php foreach($_SESSION['managers'] as $m){ ?>
<tr>
<td><?= $m['id']; ?></td>
<td><?= $m['name']; ?></td>
<td><?= $m['username']; ?></td>
<td><?= $m['email']; ?></td>
<td><?= $m['status']; ?></td>
</tr>
<?php } ?>
</table>

</div>
</div>

<!-- MANAGER -->
<div id="manager" class="section">
<div class="card">
<h2>Manage Account Managers</h2>

<form method="POST">
<input type="hidden" name="id" value="<?php echo $edit['id'] ?? ''; ?>">
<input type="text" name="name" placeholder="Name" value="<?php echo $edit['name'] ?? ''; ?>" required>
<input type="text" name="username" placeholder="Username" value="<?php echo $edit['username'] ?? ''; ?>" required>
<input type="email" name="email" placeholder="Email" value="<?php echo $edit['email'] ?? ''; ?>" required>

<?php if($edit): ?>
<button class="add-btn" name="update">Update Manager</button>
<?php else: ?>
<button class="add-btn" name="add">+ Add New Manager</button>
<?php endif; ?>
</form>

<table>
<tr>
<th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Status</th><th>Action</th>
</tr>
<?php foreach($_SESSION['managers'] as $m){ ?>
<tr>
<td><?= $m['id'] ?></td>
<td><?= $m['name'] ?></td>
<td><?= $m['username'] ?></td>
<td><?= $m['email'] ?></td>
<td><?= $m['status'] ?></td>
<td>
<a class="edit-btn" href="?edit=<?= $m['id'] ?>">Edit</a>
<a class="delete-btn" href="?delete=<?= $m['id'] ?>" onclick Delete="return confirm('Are you sure you want to logout?'">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>

<!-- REPORTS -->
<div id="reports" class="section">
<div class="card">
<h2>📊 System Reports</h2>
<div class="boxes">
<div class="box"><h3>Total Managers</h3><p><?php echo count($_SESSION['managers']); ?></p></div>
<div class="box"><h3>Total Accounts</h3><p>12</p></div>
<div class="box"><h3>Total Vouchers</h3><p>25</p></div>
<div class="box"><h3>Total Users</h3><p>8</p></div>
</div>
</div>
</div>

<!-- SETTINGS -->
<div id="settings" class="section">
<div class="card">
<h2>⚙ System Settings</h2>
<div class="boxes">
<div class="box"><h3>System Name</h3><p>AMS</p></div>
<div class="box"><h3>Version</h3><p>1.0</p></div>
<div class="box"><h3>Status</h3><p>Active</p></div>
<div class="box"><h3>Security</h3><p>ON</p></div>
</div>
</div>
</div>

</div>

<script>
function showPage(page) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.getElementById(page).classList.add('active');
}

window.onload = function() {
    showPage('<?php echo $activePage; ?>');
}
</script>

</body>
</html>