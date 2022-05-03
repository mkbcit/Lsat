<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lsat | SSR Primer</title>
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
		 color:black;
		 font: 15px sans-serif;
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
		

	<div style="padding-top:2px">
	<table style="width:100%">
	     <tr>
		<td id="left" style="width:30%;">	
		<h2> SSR Primer Design  Summary</h2>

		<?php
			// get SSR search parameter and data file name 
			 $fname = $_GET['datafilename'];
			// echo  $fname; echo '<br>';
		// this block is ok -------------->
			
			// system("perl /opt/lampp/htdocs/Lsat/LsatMISA.pl  /opt/lampp/htdocs/Lsat/SSROutPut/$db_file"); // SSR search perl script call
			// Primer3 input data file generate 
			// P3 input file name
			 $piname="$fname".".SSR"; 	//echo $piname; echo '<br>';
			// P3in perl  Running -------->
			system ("perl /opt/lampp/htdocs/Lsat/lsatp3in.pl /opt/lampp/htdocs/Lsat/SSROutPut/$piname");
		
			
			// primer3 exe input file name creates
			//echo '<br>';

			$pexeinfn="$piname".".p3in";  
	
			$hrik="/opt/lampp/htdocs/Lsat/SSROutPut/$pexeinfn";
			$x="$piname".".p3out";
			$primercoreoutfn="/opt/lampp/htdocs/Lsat/SSROutPut/$x";

			system ("primer3_core < $hrik> $primercoreoutfn "); 

		//	echo "RUN p3out "; echo '<br>';
		//--------------------------------->
			//Primer3 output generating
			system ("perl /opt/lampp/htdocs/Lsat/lsatp3out.pl   /opt/lampp/htdocs/Lsat/SSROutPut/$x  /opt/lampp/htdocs/Lsat/SSROutPut/$piname"); 
		
			$linkprimer ="$piname".".CSV";  
			$ssrmarker="$piname".".results"; 
		
		?>
		<br><br>
		<h3> SSR Primer download</h3>
		<a href="/Lsat/SSROutPut/<?php echo "$linkprimer"?>" download>  Download SSR Primer  [sequences]</a>
		<br>
	<!--	<a href="/Lsat/SSROutPut/<?php echo "$ssrmarker"?>" download>  Download SSR Primer database  [detail]</a> --->
		
	</td>
	<td id="right" style="width:30%; float:left">
	<h2> SSR Primer Display  </h2>
	<div style="width: 850px; height: 450px; overflow: scroll">  
		<?php
		echo "<table class='csvtab display responsive-table'>\n\n";
		$flnp ="$piname".".CSV";  
		//echo $flnp;
		$flnpx="./SSROutPut/$flnp";
		$f = fopen($flnpx, "r") or die("Unable to open csv file!");

		echo "<thead >";
		echo "<tr class='csvtr' >";
		echo "<td style='background: #ee9; width: 180px; height: 20px;'>Seq ID</td>";
		echo "<td style='background: #ee9; width: 100px;'>SSR ID</td>";
		echo "<td style='background: #ee9; width: 200px;'>F Primer</td>";
		echo "<td style='background: #ee9; width: 200px;'>R Primer</td>";
		echo "<td style='background: #ee9;'>PCR Product</td>";
		/*echo "<td style='background: #ee9;'>SSR Class</td>";
		echo "<td style='background: #ee9;'> motif Rich in</td>";
		echo "<td style='background: #ee9; width: 400px; height: 20px;'>Flanking Seq</td>";*/
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

	</td>
	</tr>
	<tr><td collspan="2" id="bottom">   
	<table>
		<tr>
		<td  style="width:70%;  padding-left:120px;">
		<span style="color:yellow">Cite US: </span>&nbsp; &nbsp; Biswas et al (2018) Lsat:&nbsp; web-based micro-satellite analysis tool for family Liliaceae. 
									http://210.110.86.160/Lsat/Lsat.html	 <br>
		<span style="color:yellow">Contuct US: </span> mkbcit@ymail.com <br>
		</td>
		<td  style="width: 40%">
		<span style="color:yellow">Useful Link  </span><br> <a href="http://210.110.86.160/Lidb/Lilidb_Home.html"> Lili-db </a><br>
		</td>
		<td  style="width: 10%">
		</td>		
		</tr>
	</table>


	</td></tr>
	</table>
	</div>
		
</div>			
</body>
</html>

