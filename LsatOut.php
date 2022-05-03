<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lsat | SSR Result</title>
<link rel="shortcut icon" href="icon1.png">
<link href="Lsatv1.css" rel="stylesheet" type="text/css">


<style>
	.csvtab{
		table-layout: fixed;
		width:100%;
		border-collapse: collapse;
		border: 2px blue solid;
		font: 12px sans-serif;
	}
	.csvtr{
		 background: #ee9;
		 color:blue;
		 font: 14px sans-serif;
	}
	table.display th{ background: #D5E0CC; }
	table.display td{ 	background: #fff; 
						border: 1px green solid; 
						padding: 5px; 
						word-wrap: break-word;				  	
	}

	table.responsive-table{
	  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
	}

</style>

<style type="text/css">
	a:link    {color:#BCC0BB; background-color:transparent; text-decoration:none}
	a:visited {color:pink; background-color:transparent; text-decoration:none}
	a:hover   {color:blue; background-color:transparent; text-decoration:underline}
	a:active  {color:yellow; background-color:transparent; text-decoration:underline}
</style>

</head>

<body>
<div id="wrapper">
  <header>
	<table> 
		<td>
			<img alt="LsatLogo"   height="120" src="lsatlogo.png" width="121" />
		</td>
		<td>
			Lsat:&nbsp; web-based micro-satellite analysis tool for family Liliaceae 
		</td> 
	</table>
  </header>

	

<table style="width: 100%; height: 700px; ">
  <tr>
    <td id="left" style="width:30%">
	<h2> Analysis Summary  </h2>

	<?php
	// get SSR search parameter and data file name 
	 $db_file = $_GET['dbname'];
	 $SSR_Param_di = $_GET['di'];
	 $SSR_Param_tr = $_GET['Tri'];
	 $SSR_Param_te = $_GET['Tetra'];
	 $SSR_Param_pe = $_GET['Penta'];
	 $SSR_Param_hx = $_GET['Hexa'];  
	 $linka= "$db_file".".SSR";  
	 $linkb="$db_file".".Sumary";  
	 
	?>

	<?php
	// prepare SSR ini file 
	//definition(unit_size,min_repeats):            2-?	3-? 4-? 5-? 6-? 
	//interruptions(max_difference_between_2_SSRs):        0

	$ssr_pr ="definition(unit_size,min_repeats): 2-$SSR_Param_di  3-$SSR_Param_tr  4-$SSR_Param_te   5-$SSR_Param_pe   6-$SSR_Param_hx";

	$myfile = fopen("/opt/lampp/htdocs/Lsat/param.ini", "w") or die("Unable to open file!");
	$txt = "$ssr_pr\n";
	fwrite($myfile, $txt);
	$txt = "interruptions(max_difference_between_2_SSRs):        0\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	?>

		
	<?php
	echo " Data file: $db_file <br> You set SSR search  Parameter Di= $SSR_Param_di Tri=$SSR_Param_tr Tetra=$SSR_Param_te Penta= $SSR_Param_pe Hexa=$SSR_Param_hx <br>" ;

	// exec("perl LsatMISA.pl /opt/lampp/htdocs/Lsat/LiliumSpESTncbi2017.fasta");
	system("perl /opt/lampp/htdocs/Lsat/LsatMISA.pl  /opt/lampp/htdocs/Lsat/SSROutPut/$db_file");

	 ?>	
<!--	<div style="hight:500px; padding-left:230px; padding-top:20px; background-color: white"> -->
	<h2> SSR analysis result download link </h2> 
	<a href="/Lsat/SSROutPut/<?php echo "$linka"?>" download>  Download SSR Analysis result  [Detail]</a>
	<br>
	<a href="/Lsat/SSROutPut/<?php echo "$linkb"?>" download>  Download SSR Analysis result  [Summary]</a>
	</td>

	<td id="right" style="width: 30%">

	<h2> SSR result display  </h2>
	<div style="width: 850px; height: 450px; overflow: scroll">  
  
	<?php
	echo "<table class='csvtab display responsive-table'>\n\n";
	$fln ="$db_file".".CSV";  
	$f = fopen($fln, "r") or die("Unable to open csv file!");

	echo "<thead >";
	echo "<tr class='csvtr' >";
	echo "<td style='background: #ee9; width: 50px; height: 20px;'>Seq ID</td>";
	echo "<td style='background: #ee9;'>SSR type</td>";
	echo "<td style='background: #ee9;'>Motif</td>";
	echo "<td style='background: #ee9;'>SSR start</td>";
	echo "<td style='background: #ee9;'>SSR end</td>";
	echo "<td style='background: #ee9;'>SSR Class</td>";
	echo "<td style='background: #ee9;'> motif Rich in</td>";
	echo "<td style='background: #ee9; width: 400px; height: 20px;'>Flanking Seq</td>";
	echo "</tr >";
	echo "</thead>";
	echo "<tbody>";

	while (($line = fgetcsv($f, 0, "\t")) !== false) {
		echo "<tr >";
		foreach ($line as $cell) {
		        echo "<td class='csvtd'>" . htmlspecialchars($cell) . "</td>";
			}
		echo "</tr>\n";

	}
	fclose($f);
	echo "</tbody>";
	echo "\n</table>"; 
	 
	?>
	</div>
	</td></tr>
<tr>
<td colspan="2" style="padding-left:750px;">
    <script>
	window.onload=function(){
		document.getElementById("SSRPrimer").style.display='none';
		}
	function showssr(){
		document.getElementById("SSRPrimer").style.display='block';
		}
     </script>


	<table>
	<tr>
	<td style="font-size:20px; font-weight: bold;"> SSR Primer Design? </td>
	<td><input type="button" id="show" value=" YES " onclick="showssr()" ></td>
	<td>
	<form id="SSRParam" action="lsatPrimerSearch.php" method="get" target="_blank" >
	<input type="hidden" name="datafilename" value="<?php echo $db_file; ?>" >
	<input type="submit" id="SSRPrimer" style="color:red; font-size:13px; font-weight:bold" value=">>>  Start SSR Primer Search  <<<" >
	</form>	
	</td>
	</tr>
	</table>
</td>
</tr>

<tr>
<td colspan="2" id="bottom">
	<table>
		<tr>
		<td  style="width:70%;  padding-left:120px;">
		<span style="color:yellow">Cite US: </span>&nbsp; &nbsp; Biswas et al (2018) Lsat:&nbsp; web-based micro-satellite analysis tool for family Liliaceae. 
									http://210.110.86.160/Lsat/Lsat.html <br>
		<span style="color:yellow">Contuct US: </span> mkbcit@ymail.com <br>
		</td>
		<td  style="width: 40%">
		<span style="color:yellow">Useful Link  </span><br> <a href="http://210.110.86.160/Lidb/Lilidb_Home.html"> Lili-db </a><br>
		</td>
		<td  style="width: 10%">
		</td>		
		</tr>
	</table>
</td>
</tr>
</table>
	 
</div>


<!-- <div style="height:300px; background-color:#003366;  padding-top:10px"> -->

</div>
		
</div>
</div>	
</body>
</html>

