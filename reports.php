<!DOCTYPE html>
<html>
<head>
<title>Reports</title>

<style>

body{
background:#9ad9ce;
font-family:Arial;
padding:20px;
}

/* Main Card */
.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

/* Title */
h2{
color:#1f4f59;
}

/* Blocks Container */
.blocks{
display:flex;
gap:15px;
margin-top:20px;
flex-wrap:wrap;
}

/* Each Block */
.box{
flex:1;
min-width:200px;
background:#3f9d92;
color:white;
padding:20px;
border-radius:10px;
text-align:center;
box-shadow:0 0 8px rgba(0,0,0,0.2);
}

.box h3{
margin-bottom:10px;
}

.box p{
font-size:22px;
font-weight:bold;
}

</style>
</head>

<body>

<div class="card">

<!-- TOP HEADING -->
<h2>System Reports</h2>

<!-- BLOCKS -->
<div class="blocks">

<div class="box">
<h3>Total Managers</h3>
<p>4</p>
</div>

<div class="box">
<h3>Total Accounts</h3>
<p>12</p>
</div>

<div class="box">
<h3>Total Vouchers</h3>
<p>25</p>
</div>

<div class="box">
<h3>Total Users</h3>
<p>8</p>
</div>

</div>

</div>

</body>
</html>