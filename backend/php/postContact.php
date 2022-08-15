<?php
require_once("libs/crgHeaders.php");
require_once("libs/crgMySqlLibLocal.php");
require_once("libs/crgCommonLib.php");

$retArr["status"] = "Success";
$newCustomerName = "";
$newRegistrationNumber = "";
$logFile = 'postContact';


if (isset($_POST["data"])) { 
	$data = $_POST["data"];
	$d = json_decode($data);
    $retArr["posted"] = $d;
	doLog(print_r($d, true));
} else {
	$retArr["status"] = "Error"; 
	$retArr["description"]= "data not in POST parameter";
	echo json_encode($retArr);
	exit;
};

try {
	// check if quote id exists, get quote id
    // insert quote id and contact details into contact table
	$SQL = "SELECT id FROM quote WHERE id = {$d->clientOverview->quoteId}";
	doLog($SQL);
	$returnQuoteRows = crgMySqlgetRowArr($SQL);
	if (sizeof($returnQuoteRows) > 0) {
        // update contacts if quote_id exists in contact table
        $SQL = "SELECT id FROM contact WHERE quote_id = {$d->clientOverview->quoteId}";
        doLog($SQL);
	    $returnContactRows = crgMySqlgetRowArr($SQL);
        if (sizeof($returnContactRows) > 0) {
            $retArr["contactId1"] = $returnContactRows[0]['id'];
            $retArr["contactId2"] = $returnContactRows[1]['id'];
            $retArr["contactId3"] = $returnContactRows[2]['id'];
            $retArr["description"] = 'Contact exists in contact table';
            $SQL1 = "UPDATE contact
					SET name = '".$d->clientOverview->contactPerson."',
						designation = '".$d->clientOverview->designation."',
						email = '".$d->clientOverview->email."',
						fax_number = '".$d->clientOverview->faxNo."',
						tel_number = '',
						cell_number = '".$d->clientOverview->cellNo."',
						upd_date = CURRENT_TIMESTAMP
					WHERE contact_type = 1 AND quote_id = {$d->clientOverview->quoteId}";
			doLog($SQL1);
			crgExecMySql($SQL1);
            $SQL2 = "UPDATE contact
					SET name = '".$d->decisionMaker->clientName."',
						designation = '',
						email = '".$d->decisionMaker->clientEmail."',
						fax_number = '".$d->decisionMaker->clientFaxNo."',
						tel_number = '".$d->decisionMaker->clientTelNo."',
						cell_number = '".$d->decisionMaker->clientCellNo."',
						upd_date = CURRENT_TIMESTAMP
					WHERE contact_type = 2 AND quote_id = {$d->clientOverview->quoteId}";
			doLog($SQL2);
			crgExecMySql($SQL2);
            $SQL3 = "UPDATE contact
					SET name = '".$d->account->accContactName."',
						designation = '',
						email = '".$d->account->accEmailAddress."',
						fax_number = '".$d->account->accFaxNo."',
						tel_number = '".$d->account->accTelNo."',
						cell_number = '".$d->account->accCellNo."',
						upd_date = CURRENT_TIMESTAMP
					WHERE contact_type = 3 AND quote_id = {$d->clientOverview->quoteId}";
			doLog($SQL3);
			crgExecMySql($SQL3);
            $SQL4 = "UPDATE contact
					SET name = '".$d->payment->payName."',
						designation = '',
						email = '".$d->payment->payEmail."',
						fax_number = '".$d->payment->payFaxNo."',
						tel_number = '".$d->payment->payTelNo."',
						cell_number = '".$d->payment->payCellNo."',
						upd_date = CURRENT_TIMESTAMP
					WHERE contact_type = 4 AND quote_id = {$d->clientOverview->quoteId}";
			doLog($SQL4);
			crgExecMySql($SQL4);
        } else {
		$SQL = "INSERT INTO contact (name,
                                    quote_id,
                                    contact_type,
                                    designation,
                                    email,
                                    fax_number,
									tel_number,
                                    cell_number)
				VALUES ('".$d->clientOverview->contactPerson."',
                        '".$d->clientOverview->quoteId."',
                        1,
                        '".$d->clientOverview->designation."',
                        '".$d->clientOverview->email."',
                        '".$d->clientOverview->faxNo."',
						'',
                        '".$d->clientOverview->cellNo."'),
						('".$d->decisionMaker->clientName."',
                        '".$d->clientOverview->quoteId."',
                        2,
                        '',
                        '".$d->decisionMaker->clientEmail."',
                        '".$d->decisionMaker->clientFaxNo."',
						'".$d->decisionMaker->clientTelNo."',
                        '".$d->decisionMaker->clientCellNo."'),
						('".$d->account->accContactName."',
                        '".$d->clientOverview->quoteId."',
                        3,
                        '',
                        '".$d->account->accEmailAddress."',
                        '".$d->account->accFaxNo."',
						'".$d->account->accTelNo."',
                        '".$d->account->accCellNo."'),
						('".$d->payment->payName."',
                        '".$d->clientOverview->quoteId."',
                        4,
                        '',
                        '".$d->payment->payEmail."',
                        '".$d->payment->payFaxNo."',
						'".$d->payment->payTelNo."',
                        '".$d->payment->payCellNo."')";
		doLog($SQL);
		crgExecMySql($SQL);
		$retArr["contactId"] = lastInsertedId();
        }
	}

    crgCommitMySql();
} catch (exception $e) {
	$retArr["status"] = "Error";
	$retArr["description"] = print_r($e, true);
	crgRollbackMySql();	
}

echo json_encode($retArr);
?>