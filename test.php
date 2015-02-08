<?php
 error_reporting(E_ALL ^ E_NOTICE); 
 header("Content-Type: application/javascript");

//$_GET['address'] = '1248 W Adams Blvd APT 101';
//$_GET['city'] = 'Los Angeles';
//$_GET['state'] ='CA';

$url1 = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1dxngq2ps7f_9od0r&address=".$_GET['address']."&citystatezip=".$_GET['city'].", ".$_GET['state']."&rentzestimate=true";

$xmlresult = simplexml_load_file($url1);

$Result = $xmlresult->response[0]->results[0]->result[0];

$homedetails = $Result->links[0]->homedetails[0];

$street = $Result->address[0]->street[0];

$city = $Result->address[0]->city[0];

$state = $Result->address[0]->state[0];

$zipcode = $Result->address[0]->zipcode[0];

$latitude = $Result->address[0]->latitude[0];

$longitude = $Result->address[0]->longitude[0];

$useCode = $Result->useCode[0];

$lastSoldPrice = number_format((double)$Result->lastSoldPrice[0], 2, '.', ',');

$yearBuilt = $Result->yearBuilt[0];

$lastSoldDate = date_Reformat($Result->lastSoldDate[0]);

$lotSizeSqFt = $Result->lotSizeSqFt[0];

$estimateLastUpdate = date_Reformat($Result->zestimate[0]->{'last-updated'}[0]);

$estimateAmount =number_format((double)$Result->zestimate[0]->amount[0], 2, '.', ',');

$finishedSqFt = $Result->finishedSqFt[0];


$imgn = "http://www-scf.usc.edu/~csci571/2014Spring/hw6/down_r.gif";

$imgp = "http://www-scf.usc.edu/~csci571/2014Spring/hw6/up_g.gif";

$estimateValueChange = number_format((double)abs($Result->zestimate[0]->valueChange[0]), 2, '.', ',');

$bathrooms = $Result->bathrooms[0];

$estimateValuationRangeLow = number_format((double)$Result->zestimate[0]->valuationRange[0]->low[0], 2, '.', ',');

$estimateValuationRangeHigh = number_format((double)$Result->zestimate[0]->valuationRange[0]->high[0], 2, '.', ',');

$bedrooms = $Result->bedrooms[0];

$restimateLastUpdate = date_Reformat($Result->rentzestimate[0]->{'last-updated'}[0]);

$restimateAmount = number_format((double)$Result->rentzestimate[0]->amount[0], 2, '.', ',');

$taxAssessmentYear = $Result->taxAssessmentYear[0];

$restimateValueChange = number_format((double)abs($Result->rentzestimate[0]->valueChange[0]), 2, '.', ',');

$taxAssessment = number_format((double)$Result->taxAssessment[0], 2, '.', ',');  

$restimateValuationRangeLow = number_format((double)$Result->rentzestimate[0]->valuationRange[0]->low[0], 2, '.', ','); 

$restimateValuationRangeHigh =  number_format((double)$Result->rentzestimate[0]->valuationRange[0]->high[0], 2, '.', ','); 

if ($Result->zestimate[0]->valueChange[0] < 0) {
	$estimateValueChangeSign = "-";
}else if ($Result->zestimate[0]->valueChange[0] > 0){
	$estimateValueChangeSign = "+";
}

if($Result->rentzestimate[0]->valueChange[0] < 0){
	$restimateValueChangeSign = "-";
}else if ($Result->rentzestimate[0]->valueChange[0] > 0){
	$restimateValueChangeSign = "+";
}

$zpid = $Result->zpid[0];


$url2 = "http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1dxngq2ps7f_9od0r&zpid=".$zpid;

$xmlimage = simplexml_load_file($url2);

$photoGallery = $xmlimage->response[0]->links[0]->photoGallery[0];

$image1 = $xmlimage->response[0]->images[0]->image[0]->url[0];

//echo $photoGallery;
//echo $image1;
$url3 = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1dxngq2ps7f_9od0r&unit-type=percent&zpid=".$zpid."&width=600&height=300&chartDuration=1year";
$url4 = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1dxngq2ps7f_9od0r&unit-type=percent&zpid=".$zpid."&width=600&height=300&chartDuration=5years";
$url5 = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1dxngq2ps7f_9od0r&unit-type=percent&zpid=".$zpid."&width=600&height=300&chartDuration=10years";

$xmlchart1 = simplexml_load_file($url3);
$xmlchart5 = simplexml_load_file($url4);
$xmlchart10 = simplexml_load_file($url5);

$chart1 = $xmlchart1->response[0]->url[0];
$chart5 = $xmlchart5->response[0]->url[0];
$chart10 = $xmlchart10->response[0]->url[0];

$arraychart1 = array(
				"url" => "$chart1"
	);

$arraychart5 = array(
				"url" => "$chart5"
	);

$arraychart10 = array(
				"url" => "$chart10"
	);
$chart = array(
			"1year" => $arraychart1,
			"5years" => $arraychart5,
			"10years" => $arraychart10

			);

$result = array(
				"homedetails" => "$homedetails",
				"street" => "$street",
				"city" => "$city",
				"state" => "$state",
				"zipcode" => "$zipcode",
				"latitude" => "$latitude",
				"longitude" => "$longitude",
				"useCode" => "$useCode",
				"lastSoldPrice" => "$lastSoldPrice",
				"yearBuilt" => "$yearBuilt",
				"lastSoldDate" => "$lastSoldDate",
				"lotSizeSqFt" => "$lotSizeSqFt",
				"estimateLastUpdate" => "$estimateLastUpdate",
				"estimateAmount" => "$estimateAmount",
				"finishedSqFt" => "$finishedSqFt",
				"estimateValueChangeSign" => "$estimateValueChangeSign",
				"imgn" => "$imgn",
				"imgp" => "$imgp",
				"estimateValueChange" => "$estimateValueChange",
				"bathrooms" => "$bathrooms",
				"estimateValuationRangeLow" => "$estimateValuationRangeLow",
				"estimateValuationRangeHigh" => "$estimateValuationRangeHigh",
				"bedrooms" => "$bedrooms",
				"restimateLastUpdate" => "$restimateLastUpdate",
				"restimateAmount" => "$restimateAmount",
				"taxAssessmentYear" => "$taxAssessmentYear",
				"restimateValueChangeSign" => "$restimateValueChangeSign",
				"restimateValueChange" => "$restimateValueChange",
				"taxAssessment" => "$taxAssessment",
				"restimateValuationRangeLow" => "$restimateValuationRangeLow",
				"restimateValuationRangeHigh" => "$restimateValuationRangeHigh"

	);

$images = array(

			"photoGallery" => "$photoGallery",
			"image1" => "$image1"

	);

$output = array(


			"result" => $result,
			"images" => $images,
			"chart" => $chart

	);


function date_Reformat( $date )
{
    $monthList = array
    (
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
    );

    $tmp = explode( '/', $date );
    $month = $monthList[ $tmp[0]-1 ];

    return $tmp[1]."-".$month."-".$tmp[2];
}


echo $_GET['callback'] . '('.json_encode($output).')';

?>