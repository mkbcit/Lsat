#!"c:\xampp\perl\bin\perl.exe"
# Author: Manosh Kumar Biswas
# Program name: lsatp3in.pl
# Description: creates a PRIMER3 input file based on SSR search results
#  
##		   

open (IN,"<$ARGV[0]") || die ("\nError: Couldn't open  SSR results file (*.ssr) !\n\n");


my $filename = $ARGV[0];
$filename =~ s/\.ssr//;

# out put file name generate
my @ff=split("/", $filename);
my $fa=$ff[6];

my $pinfn="$fa".".p3in";  

my $ffSSR="/opt/lampp/htdocs/Lsat/SSROutPut/$pinfn";


open (OUT, '>', $ffSSR);


while (<IN>)
	  {
	  chomp;
	  @data = split (/\t/);

		$id  =$data[0],
		$ssr_nr =$data[1],
		$size=$data[4],
		$flseq=$data[8],
		$target=$data[10];	


	 print OUT "PRIMER_SEQUENCE_ID=$id"."_$ssr_nr\nSEQUENCE_TEMPLATE=$flseq\n";
	 print OUT "PRIMER_PRODUCT_SIZE_RANGE=100-280\n";
	 print OUT "TARGET=",$target,",",$size+6,"\n";
	 print OUT "PRIMER_MIN_SIZE=18\n";
	 print OUT "PRIMER_MAX_SIZE=21\n";
	 print OUT "PRIMER_MIN_TM=50\n";
	 print OUT "PRIMER_MAX_TM=55\n";
	 print OUT "PRIMER_OPT_TM=53\n";
	 print OUT "PRIMER_MAX_END_STABILITY=250\n=\n";

    };
