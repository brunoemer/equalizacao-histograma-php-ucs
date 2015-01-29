<?php
	include('Imagem.php');
	
	$img = new Imagem();
	$cor = $img->vetor;
	 /* CAT:Bar Chart */ 

	 /* pChart library inclusions */ 
	 include("pChart/class/pData.class.php"); 
	 include("pChart/class/pDraw.class.php"); 
	 include("pChart/class/pImage.class.php"); 
	
	 /* Create and populate the pData object */ 
	 $MyData = new pData();
	 
	 foreach($cor as $i => $num){
	 	 $arr = imagecolorsforindex($img, $i);
		 //$cor_hex = dec2hex($arr['red']).dec2hex($arr['green']).dec2hex($arr['blue']);
		 $MyData->addPoints(array($num), $i);
		 $MyData->setPalette($i, array('R' => $arr['red'], 'G' => $arr['green'], 'B' => $arr['blue']));
		 $i++;
	 }
	 
	 $MyData->setAxisName(0, "Quantidade"); 
	 //$MyData->addPoints(array("January","February","March","April","May","Juin","July","August","September"),"Months"); 
	 $MyData->setSerieDescription("Months", "Month"); 
	 $MyData->setAbscissa("Months"); 
	
	 /* Create the pChart object */ 
	 $myPicture = new pImage(1000,400,$MyData); 
	
	 /* Turn of Antialiasing */ 
	 $myPicture->Antialias = FALSE; 
	
	 /* Add a border to the picture */ 
	 $myPicture->drawRectangle(0,0,999,399,array("R"=>0,"G"=>0,"B"=>0)); 
	
	 /* Set the default font */ 
	 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/pf_arma_five.ttf","FontSize"=>6)); 
	
	 /* Define the chart area */ 
	 $myPicture->setGraphArea(60,40,900,350); 
	
	 /* Draw the scale */ 
	 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE); 
	 $myPicture->drawScale($scaleSettings); 
	
	 /* Write the chart legend */ 
	 //$myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL)); 
	
	 /* Turn on shadow computing */  
	 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
	
	 /* Draw the chart */ 
	 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
	 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>FALSE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
	 $myPicture->drawBarChart(); 
	
	 /* Render the picture (choose the best way) */ 
	 $myPicture->autoOutput("example.drawBarChart.simple.png"); 
?>