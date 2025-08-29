<?php require_once('localonly.php'); ?>
<?php require_once('dbfunctions.php'); ?>
<?php

$sqlSet = [ 'family'   => [ 'participant' => 'SELECT * from participant WHERE family = {id}' ]
];

function addRows($parentNode, $nodeName, $childSelectSQL) {
    global $sqlSet;
    global $db;

    $sqlArray = NULL;
    if (array_key_exists($nodeName, $sqlSet)) {
        // Following is a *shallow* copy. If not -- if copied only by reference -- we'll have to repeat the arrays_key loop for *each* sql statement before recursing
        $sqlArray = $sqlSet[$nodeName];
    }

    // Fetch data
    $records = $db->query($childSelectSQL);

    if ($records->num_rows > 0) {
        while ($row = $records->fetch_assoc()) {
            $node = $parentNode->addChild($nodeName);
            /* Add fields as XML element children */
            foreach (array_keys($row) as $fieldName) {
                $node->addChild($fieldName, $row[$fieldName]);
                }
            /* Add records from linked tables as XML element children */
            if ($sqlArray) {
                foreach (array_keys($sqlArray) as $childName) {
                    $sql = $sqlArray[$childName];
                    /* Subsitute field values for field names, e.g. {id} => 13 */
                    foreach (array_keys($row) as $fieldName) {
                        $sql = str_replace('{' . $fieldName . '}', $row[$fieldName], $sql);
                    }
                    /* Recurse to actually do the job */
                    addRows($node, $childName, $sql);
                }
            }
        }
    }
}

// Create XML document
$rootNode = new SimpleXMLElement('<families/>');

addRows($rootNode, 'family', 'SELECT * from family');

// Set header for XML output
header('Content-type: text/xml');

// Output XML
echo $rootNode->asXML();

$db->close(); /* tmp */
?>
