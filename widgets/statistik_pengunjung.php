<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php

$CI =& get_instance();
$CI->load->library('user_agent');

if ($CI->agent->is_browser())
{
        $browser = $CI->agent->browser().' '.$CI->agent->version();
}
elseif ($CI->agent->is_robot())
{
        $browser = $CI->agent->robot();
}
elseif ($CI->agent->is_mobile())
{
        $browser = $CI->agent->mobile();
}
else
{
        $browser = 'Tidak ditemukan';
}

$ip = $CI->input->ip_address();
$os = $CI->agent->platform();

if(!isset($_SESSION['MemberOnline']))
{
	$cek = $this->db->query("SELECT Tanggal,ipAddress FROM sys_traffic WHERE Tanggal='".date("Y-m-d")."'");
	if($cek->num_rows()==0)
	{
		$up = $this->db->query("INSERT INTO sys_traffic (Tanggal,ipAddress,Jumlah) VALUES ('".date("Y-m-d")."','".$ip."','1')");
		$_SESSION['MemberOnline']=date('Y-m-d H:i:s');
	}
	else
	{
		$res = $cek->result_array();
		$ipaddr = $res['ipAddress'].$ip;
		$up = $this->db->query("UPDATE sys_traffic SET Jumlah=Jumlah + 1,ipAddress='".$ipx."' WHERE Tanggal='".date("Y-m-d")."'");
		$_SESSION['MemberOnline']=date('Y-m-d H:i:s');
	}
}

$rs = $this->db->query('SELECT Jumlah AS Visitor FROM sys_traffic WHERE Tanggal="'.date("Y-m-d").'" LIMIT 1');
if($rs->num_rows()>0)
{
	$visitor = $rs->row(0);
	$today = $visitor->Visitor;
}
else
{
	$today = 0;
}

$strSQL = "SELECT Jumlah AS Visitor FROM sys_traffic WHERE Tanggal=(SELECT DATE_ADD(CURDATE(),INTERVAL -1 DAY) FROM sys_traffic LIMIT 1) LIMIT 1";
$rs = $this->db->query($strSQL);
if($rs->num_rows()>0)
{
	$visitor = $rs->row(0);
	$yesterday = $visitor->Visitor;
}
else
{
	$yesterday = 0;
}

$rs = $this->db->query('SELECT SUM(Jumlah) as Total FROM sys_traffic');
$visitor = $rs->row(0);
$total = $visitor->Total;
		
?>
<ul class="cont-info-list2 list-unstyled w-100">
	<li>Hari ini : <?= ribuan($today) ?></li>
	<li>Kemarin : <?= ribuan($yesterday) ?></li>
	<li>Total : <?= ribuan($total) ?></li>
	<!-- <li>Online : <?= ribuan(count($_SESSION['MemberOnline'] - 300)) ?></li>
	<li>Sistem Operasi : <?=  $os; ?></li>
	<li>IP Address : <?= $ip; ?></li> -->
	<!-- <li>Browser : <?= $browser; ?></li> -->
</ul>