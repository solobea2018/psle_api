<?php
// File: get_student_result.php
header("Content-Type: application/json; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors',1);

// Input parameters
$year   = $_GET['year']   ?? '';
$school = $_GET['school'] ?? '';
$index  = $_GET['index']  ?? '';

if(!$year || !$school || !$index) {
    echo json_encode([
        "error" => "Missing parameters. Please provide year, school number, and index."
    ]);
    exit;
}

// Construct URL (assuming pattern as in your example)
$url = "https://onlinesys.necta.go.tz/results/{$year}/psle/results/shl_".strtolower($school).".htm";

// Fetch the page content
$html = @file_get_contents($url);
if($html === false) {
    echo json_encode([
        "error" => "Could not fetch results page for school: {$school} and year: {$year}."
    ]);
    exit;
}

// Now parse HTML to find the student row with the given index
// Example row: <TR>…<TD>PS0401058-0001</TD> … <TD>… Kiswahili - A, English - A, … Average Grade - A</TD></TR>
// We'll use DOMDocument and XPath for more reliable parsing

libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
$xpath = new DOMXPath($dom);

// Find table rows under the table with student data
$rows = $xpath->query("//table[@bgcolor='LIGHTYELLOW']//tr");

// Prepare result
$found = false;
$resultData = null;

foreach($rows as $row) {
    $tds = $xpath->query("td", $row);
    if($tds->length >= 4) {
        $candNo = trim($tds->item(0)->textContent);
        if(strcasecmp($candNo, "{$school}-{$index}") === 0) {
            $premNo  = trim($tds->item(1)->textContent);
            $sex     = trim($tds->item(2)->textContent);
            $subjects= trim($tds->item(3)->textContent);

            $resultData = [
                "year"        => $year,
                "school"      => $school,
                "index"       => $index,
                "candidate_no"=> $candNo,
                "prem_no"     => $premNo,
                "sex"         => $sex,
                "subjects"    => $subjects
            ];
            $found = true;
            break;
        }
    }
}

if(!$found) {
    echo json_encode([
        "error" => "No result found for index {$index} at school {$school} for year {$year}."
    ]);
    exit;
}

// Output result
echo json_encode($resultData);
?>
