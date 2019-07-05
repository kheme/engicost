<?
require "../conn";
if (isset($_GET['logout'])) { // Logs user out and terminates eBSta session
 if (ge("logout")==null) {unset($_SESSION['ebsta_user']);unset($_SESSION['ebsta_pass']);}
}
val();
head("Websites");
if (isset($_GET['good'])) {
$id=ge("good");
if (mysql_query("update dir set status=1 where id='$id'")) {echo "Accepted Successfully!";}
else {echo "Activation Failed!";}
}
else if (isset($_GET['bad'])) {
$id=ge("bad");
if (mysql_query("update dir set status=2 where id='$id'")) {echo "Rejected Successfully!";}
else {echo "Rejection Failed!";}
}
?>
<div>
<table border="0" width="100%" id="table1" style="font-size:smaller;border-collapse: collapse" cellspacing="1">
<tr><td width="3%"></td><td width="3%"></td>
<td bgcolor="#C0C0C0" width="20%"><strong>Email</strong></td>
<td bgcolor="#C0C0C0" width="20%"><strong>Title</strong></td>
<td bgcolor="#C0C0C0" width="20%"><strong>URL</strong></td>
<td bgcolor="#C0C0C0" width="37%"><strong>Description</strong></td></tr>
<?
$a=mysql_query("select * from dir where status='0'");
$b=ro($a);
for ($c=0;$c<$b;$c++) {
$id=re($a,$c,'id');
$owner=re($a,$c,'owner');
$title=re($a,$c,'title');
$url=re($a,$c,'url');
$desc=re($a,$c,'desc');
echo "<tr valign=\"top\"><td style="text-align:center"><a href=\"index.php?good=$id\" onclick=\"if (!confirm('Are you sure you want to ACCEPT this website?')) {return false;}\"><img src=\"../images/correct.gif\" border=\"0\" title=\"Click to accept\"></a></td><td align=\"center\"><a href=\"index.php?bad=$id\" onclick=\"if (!confirm('Are you sure you want to REJECT this website?')) {return false;}\"><img src=\"../images/delete.gif\" border=\"0\" title=\"Click to reject\"></a></td><td>$owner</td><td>$title</td><td>$url</td><td>$desc</td></tr>";
}
?>
</table>
</div>
</body>
</html>