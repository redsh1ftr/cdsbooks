    <?php

    

class CreateInvoice extends Eloquent {


	static function lastchance_verbiage(){
		$jobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('jobnum'))->first();
		$includedjobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('incjob'))->first();
		$caseinfo = DB::table('locases')->where('casenum', '=', $jobinfo->casenum)->first();
		$pages = Input::get('pages');
		$ogpages = Input::get('ogpages');
	 	$ogpagecount = Input::get('suppages');
	 	$cdcount = Input::get('cds');
	 	$dvdcount = Input::get('dvds'); 
	 	$filmcount = Input::get('films');
	 	$other = Input::get('other');
		$otherquantity = Input::get('otherquantity');
		$digitized = Input::get('digitized');


		if($pages > ''){

			$pagescount = "$pages Pages";

		}else{

			$pagescount = '';
		}



		if($ogpagecount > ''){
		
			$suppagescount = " $ogpagecount Supplemental Pages ";

		}else{ 

			$suppagescount = "";
		}



		if($dvdcount > ''){

			$dvdverbiage = " $dvdcount X-ray DVDs ";

		}else{

			$dvdverbiage = "";
		}


		if($cdcount > ''){

			$cdverbiage = " $cdcount X-ray CDs ";

		}else{
			
			$cdverbiage = "";

		}


		if($filmcount > ''){

			if($digitized == '1'){

				$filmverbiage = " 1 X-ray CD (Contains $filmcount digitized films) ";

			}else{

			$filmverbiage = " $filmcount X-ray Films ";
			}

		}else{	

			$filmverbiage = "";

		}


		if($other > ''){

			$otherverbiage = " $otherquantity $other ";

		}else{

			$otherverbiage = "";

		}

		$verb = " $pagescount $cdverbiage $dvdverbiage $filmverbiage $suppagescount $otherverbiage";

		return($verb);
	}

	static function verbiage(){

		$jobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('jobnum'))->first();
		$includedjobinfo = DB::table('lojob')->where('jobnum', '=', Input::get('incjob'))->first();
		$caseinfo = DB::table('locases')->where('casenum', '=', $jobinfo->casenum)->first();
		$pages = Input::get('pages');
		$ogpages = Input::get('ogpages');
	 	$ogpagecount = Input::get('suppages');
	 	$cdcount = Input::get('cds');
	 	$dvdcount = Input::get('dvds'); 
	 	$filmcount = Input::get('films');
	 	$other = Input::get('other');
		$otherquantity = Input::get('otherquantity');
		$digitized = Input::get('digitized');
		$abstract = Input::get('abstract');

		if($abstract > ''){
			$abstractverb = " - AMENDED/ABSTRACTED SUBPOENA";
		}else{
			$abstractverb = ''; 
		}


		if($pages > ''){

			$pagescount = "$pages Pages";

		}else{

			$pagescount = '';
		}



		if($ogpagecount > ''){
		
			$suppagescount = " $ogpagecount Supplemental Pages ";

		}else{ 

			$suppagescount = "";
		}



		if($dvdcount > ''){

			$dvdverbiage = " $dvdcount X-ray DVDs ";

		}else{

			$dvdverbiage = "";
		}


		if($cdcount > ''){

			$cdverbiage = " $cdcount X-ray CDs ";

		}else{
			
			$cdverbiage = "";

		}


		if($filmcount > ''){

			if($digitized == '1'){

				$filmverbiage = " 1 X-ray CD (Contains $filmcount digitized films) ";

			}else{

			$filmverbiage = " $filmcount X-ray Films ";
			}

		}else{	

			$filmverbiage = "";

		}


		if($other > ''){

			$otherverbiage = " $otherquantity $other ";

		}else{

			$otherverbiage = "";

		}
	

		if(Input::get('nrs') == 1) {

			$verb = "Preparation of No Records Statement received from Deponent $jobinfo->deponent regarding $jobinfo->nor. $caseinfo->caption";

		} elseif(Input::get('included') == 1) {

			$verb = "Cancellation of Request from Deponent $jobinfo->deponent regarding $jobinfo->nor. 
			Closing as records will be included with $includedjobinfo->deponent (CDSJOB $includedjobinfo->jobnum). $caseinfo->caption";

		}elseif(Input::get('cancelled') == 1) {

			$verb = "Cancellation of Request from Deponent $jobinfo->deponent regarding $jobinfo->nor . 
		Closing per attorney request. $caseinfo->caption";

		}elseif(Input::get('settled') == 1) {

			$verb = "Cancellation of Request from Deponent $jobinfo->deponent regarding $jobinfo->nor. 
		Closing as case has settled. $caseinfo->caption";

		}else{
			$verb = "Reproduction of Records received from Deponent $jobinfo->deponent regarding $jobinfo->nor ($pagescount $cdverbiage $dvdverbiage $filmverbiage $suppagescount $otherverbiage) - $caseinfo->caption $abstractverb";
		}


		return($verb);

		}



	static function page_price($pgcount) {
		
		$pages = $pgcount;


		if(Input::get('digitalpaper') == 'digital')
		{

			$pagetotal = ($pages * .30);

		

		}else{
		
		if($pages <= 0){

			$pagetotal = 0;

		}elseif($pages < 10){

			$pagetotal = 10.00;

		}elseif($pages <= 20){

			$pagetotal = ($pages * 1.17);

		}elseif($pages <= 50){

			$pagetotal = (23.40 + (($pages - 20) * .59));

		}elseif($pages > 50){

			$pagetotal = (41.1 + (($pages - 50) * .25));

		}}

	
		return($pagetotal);
	
}
	static function supplemental_page_price($pgcount){

		$pages = $pgcount;

		if($pages <= 20){

			$pagetotal = ($pages * 1.17);

		}elseif($pages <= 50){

			$pagetotal = (23.40 + (($pages - 20) * .59));

		}elseif($pages > 50){

			$pagetotal = (41.1 + (($pages - 50) * .25));

		}

	
		return($pagetotal);


	}





	static function postage() {
		$nrscheck = Input::get('nrs');
		$includedcheck = Input::get('included');
		$cancelledcheck = Input::get('cancelled');
		$settledcheck = Input::get('settled');

		if($nrscheck || $includedcheck || $cancelledcheck || $settledcheck == 1){

			$shipping = "6.00";

		}else{

			$shipping = CreateInvoice::shipping_cost();
		}

		return($shipping);

	}


 
	static function jt_cd_price($discprice) {
		$cd = $discprice;

		if($cd > ''){

			$cdtotal = $cd * 10;

		}else{

			$cdtotal = '';

		}

		return($cdtotal);

	}


	static function notreq_cd_price($discprice){

		$digitized = Input::get('digitized');
		$cd = $discprice;

		if($digitized == '1'){


				if($cd > ''){

				$cdtotal = ($cd * 20) +25;

			}else{

				$cdtotal = '' + 25;

		}}else{

			if($cd > ''){

				$cdtotal = ($cd * 20);

			}else{

				$cdtotal = '';


		}}

			return($cdtotal);

	}

	static function lastchance_repro(){
		$nrscheck = Input::get('nrs');
		$includedcheck = Input::get('included');
		$cancelledcheck = Input::get('cancelled');
		$settledcheck = Input::get('settled');
		$pages = Input::get('pages');
		$ogpages = Input::get('ogpages');
		$suppages = Input::get('suppages');
		$totalsup = $ogpages + $suppages;
		$random = CreateInvoice::page_price($totalsup);
		$supp = CreateInvoice::page_price($ogpages);
		$coe = Input::get('filmcoe');
		$filmfac = Input::get('filmfac');
		$resup = $random - $supp;

		if($nrscheck || $includedcheck || $cancelledcheck || $settledcheck == 1){

			$repro = "7.50";}else{

				$repro =  CreateInvoice::notreq_cd_price(Input::get('dvds')) + CreateInvoice::notreq_cd_price(Input::get('cds')) + CreateInvoice::other_price() + CreateInvoice::page_price(Input::get('pages')) + $resup;
			}

			return($repro);
	}



	static function reproduction_price() {
		$nrscheck = Input::get('nrs');
		$includedcheck = Input::get('included');
		$cancelledcheck = Input::get('cancelled');
		$settledcheck = Input::get('settled');
		$pages = Input::get('pages');
		$ogpages = Input::get('ogpages');
		$suppages = Input::get('suppages');
		$totalsup = $ogpages + $suppages;
		$random = CreateInvoice::page_price($totalsup);
		$supp = CreateInvoice::supplemental_page_price($ogpages);
		$coe = Input::get('filmcoe');
		$filmfac = Input::get('filmfac');
		$resup = $random - $supp;
		$getjt = Input::get('julietaylor');
		$abstract = Input::get('abstract');

		if($abstract > ''){
			$abstractamt = 15;
		}else{
			$abstractamt = '';
		}


		if($suppages > ''){
			$notjt_co = -10;}else{
			$notjt_co = '';}

		if($getjt == 'notjt'){
			$notjt_co = -10;}else{
			$notjt_co = '';}

		if(Input::get('digitalpaper') == 'paper'){
			$notjt_co = -10;}else{
			$notjt_co = '';}

		if($nrscheck || $includedcheck || $cancelledcheck || $settledcheck == 1){

			$repro = "7.50";}else{

		if(Input::get('julietaylor') == 'jt'){

			$jtprice = 20;
			$repro =  CreateInvoice::jt_cd_price(Input::get('dvds')) + CreateInvoice::jt_cd_price(Input::get('cds')) + CreateInvoice::other_price() + CreateInvoice::page_price(Input::get('pages')) + $resup + 20 +$abstractamt;

		}elseif(Input::get('julietaylor') == 'notjt'){

			$jtprice = 10;
			$repro =  CreateInvoice::notreq_cd_price(Input::get('dvds')) + CreateInvoice::notreq_cd_price(Input::get('cds')) + CreateInvoice::other_price() + CreateInvoice::page_price(Input::get('pages')) + $resup + 10 + $notjt_co;

		}elseif(Input::get('julietaylor') == 'requestor'){

			$jtprice = 10;
			$repro =  CreateInvoice::notreq_cd_price(Input::get('dvds')) + CreateInvoice::notreq_cd_price(Input::get('cds')) + CreateInvoice::other_price() + CreateInvoice::page_price(Input::get('pages')) + $resup + 10 + $abstractamt;

		}elseif(Input::get('julietaylor') == 'kenwilliams'){
			
			$jtprice = 15;
			$repro =  CreateInvoice::notreq_cd_price(Input::get('dvds')) + CreateInvoice::notreq_cd_price(Input::get('cds')) + CreateInvoice::other_price() + CreateInvoice::page_price(Input::get('pages')) + $resup + 15 + $abstractamt;}}
		
	

		return($repro);

	}



	static function other_price() {

			$item = Input::get('other');
			$quantity = Input::get('otherquantity');
			$coe = Input::get('otherprice');


			if($item > ''){

				$total = ($quantity * $coe);

			}else{


				$total = 0;
			}
				return($total);


	}

	static function revenue() {
		$nrscheck = Input::get('nrs');
		$includedcheck = Input::get('included');
		$cancelledcheck = Input::get('cancelled');
		$settledcheck = Input::get('settled');

		if($nrscheck > ''){
			$revacct = '40012 - No Records Statement';

		}elseif($includedcheck || $cancelledcheck || $settledcheck > ''){

			$revacct = '40011 - cancel case resolved';

		}else{

			$revacct = '40006 - Records';
		}

		return($revacct);

	}


	static function get_invoicenum() {
		
		$invnum = DB::table('invoice_defaults')->where('id', '=', 1)->pluck('invoice_number');

		return($invnum + 1);
	}

	static function add_invoicenum() {
		
		$invnum = DB::table('invoice_defaults')->where('id', '=', 1)->first();

		$plusone = $invnum->invoice_number + 1;

		$invnum->invoice_number = $plusone;

		$invnum->save();

			return View::make('invoiceform');

	}

	static function retotal() {
		$lineprice = Input::get('lineprice');
		$subpamt = Input::get('subpamt');
		$witnessamt = Input::get('witnessamt');
		$postageamt = Input::get('postageamt');

		$retotal = $lineprice + $subpamt + $witnessamt + $postageamt;

			return($retotal);

	}


	static function inject() {

		RecordsMain::create(array(
		'job_id' => Input::get('job_id'),
		'received' => $date,
		'type' => Input::get('type'),
		'quantity' => Input::get('quantity'),
		'created_user' => Session::get('user_id'),
		'updated_user' => Session::get('user_id'),
		));


	}


	static function jt_witness(){
		$witnessamt = Input::get('witnessamt');
		$filmfac = Input::get('filmfac');
		$xray = Input::get('films');
		$coe = Input::get('filmcoe');


		if($coe > '' || $filmfac > ''){



				$witamount = CreateInvoice::jt_cd_price(Input::get('dvds')) + CreateInvoice::jt_cd_price(Input::get('cds')) + ($xray * $coe) + $witnessamt + $filmfac + 15.71;

			} else {


				$witamount = CreateInvoice::jt_cd_price(Input::get('dvds')) + CreateInvoice::jt_cd_price(Input::get('cds')) + $witnessamt;

				}

				return($witamount);
			}

	static function witnessamt() {
		$witnessamt = Input::get('witnessamt');
		$filmfac = Input::get('filmfac');
		$xray = Input::get('films');
		$coe = Input::get('filmcoe');


	if(Input::get('julietaylor') == 'jt'){

		$witamount = CreateInvoice::jt_witness();
		

	}else{

		$witamount = $witnessamt;

		}

			return($witamount);

	}



static function papershipping(){

	if(Input::get('suppages') > ''){

		$pagecount = Input::get('suppages');

	}else{

		$pagecount = Input::get('pages');
	}

		if($pagecount < 10)

		{$shipcost = 6.31;}

		elseif($pagecount < 11)

		{$shipcost = 6.77;}

		elseif($pagecount < 20)

		{$shipcost = 7.24;}

		elseif($pagecount < 28)

		{$shipcost = 7.66;}

		elseif($pagecount < 36)

		{$shipcost = 8.1;}

		elseif($pagecount < 41)

		{$shipcost = 8.55;}

		elseif($pagecount < 47)

		{$shipcost = 8.99;}

		elseif($pagecount < 53)

		{$shipcost = 9.43;}

		elseif($pagecount < 61)

		{$shipcost = 10.65;}

		elseif($pagecount < 189)

		{$shipcost = 12.57;}

		elseif($pagecount < 275)

		{$shipcost = 14.49;}

		elseif($pagecount < 355)

		{$shipcost = 17.22;

		}elseif($pagecount > 355)
    	{$shipcost = 17.22;}

		

		return($shipcost);


}



static function shipping_cost(){

	if(Input::get('julietaylor') == 'jt'){

		$shipcost = 18.00;

	}elseif(Input::get('julietaylor') == 'kenwilliams'){

		$shipcost = 13.04;
	
	}elseif(Input::get('digitalpaper') == 'digital'){


		$shipcost = 7.66;

	}else{

		$shipcost = CreateInvoice::papershipping();
	}

		
	return($shipcost);
	

	}}

?>


