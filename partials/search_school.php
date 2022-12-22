// <?php
// function searchSchool()
// {
//     include '../config/db_connection.php';
//     $by_index = mysqli_real_escape_string($con, $_POST['index']);
//     $by_name = mysqli_real_escape_string($con, $_POST['name']);

//     $sql = "SELECT * FROM schools";
//     $conditions = array();

//     if (!empty($by_index)) {
//         $conditions[] = "index='$by_index'";
//     }
//     if (!empty($by_name)) {
//         $conditions[] = "index='$by_name'";
//     }

//     $query = $sql;

//     if (count($conditions) > 0) {
//         $query .= "WHERE " . implode(' AND', $conditions);
//     }

//     $result = mysqli_query($con, $query);

//     die(json_encode( $result));
// }

