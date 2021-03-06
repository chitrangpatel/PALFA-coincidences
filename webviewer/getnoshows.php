<?php

$db = new SQLite3('match_data.db');

$group_id = $_GET['group_id'];

if (!empty ($group_id)) {

    $query_string = sprintf("SELECT n.group_id, n.header_id, h.mjd, h.ra_deg, h.dec_deg FROM noshows as n LEFT JOIN headers as h ON n.header_id=h.header_id WHERE n.group_id = %s", $group_id);
    
    $stmt = $db->prepare($query_string);
    $result = $stmt->execute();

    $data = array();

    $group_id = 'blank';
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $data[] = $row;
    }
    
    echo json_encode($data);
}

?>
