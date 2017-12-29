<?php
require("db.php");

try {
    $stmt = $conn->prepare("SELECT * FROM markers");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach($stmt->fetchAll() as $k=>$v) {
        $arr[] =  $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Start XML file, create parent node

$doc = new DOMDocument('1.0', 'utf-8');

$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

foreach($arr as &$row) {
    // Add to XML document node
    $node = $doc->createElement("marker");
    $newnode = $parnode->appendChild($node);

    $newnode->setAttribute("name", $row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
}

$xmlfile = $doc->saveXML();
echo $xmlfile;

