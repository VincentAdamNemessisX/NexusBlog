<?php
function result_to_json($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return json_encode($data);
}

// Test code
//$jsondata = json_decode(result_to_json(queryData('blog')));
//foreach ($jsondata as $jsondatum) {
//    foreach ($jsondatum as $key => $value) {
//        echo "<td>" . $key . "</td> <td>" . $value . "</td><br>";
//    }
//}