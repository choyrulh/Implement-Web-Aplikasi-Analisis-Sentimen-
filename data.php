<?php
 
  header('Content-Type: application/json');

  include 'koneksi.php';

  $result = mysqli_query($conn, "SELECT DATE_FORMAT(tanggal_waktu, '%Y-%m-%d %H:%i') as menit, label, COUNT(*) as total FROM live_labels WHERE tanggal_waktu >= DATE_SUB(NOW(), INTERVAL 10 MINUTE) GROUP BY menit, label ORDER BY tanggal_waktu ASC;");

  if (!$result) {
    echo json_encode(array(
        'error' => mysqli_error($conn)
    ));
    mysqli_close($conn);
    exit;
  }
  $labels = [];
  $dukungan = [];
  $tidakMendukung = [];
  $netral = [];
  $prev_time = "";
  
  while ($row = mysqli_fetch_array($result)) {
    $time = date("Y-m-d H:i", strtotime($row['menit']));
    if ($time != $prev_time) {
      $labels[] = $time;
      $prev_time = $time;
    }
    switch ($row['label']) {
      case 'dukungan':
        $dukungan[] = $row['total'];
        break;
      case 'tidak mendukung':
        $tidakMendukung[] = $row['total'];
        break;
      case 'netral':
        $netral[] = $row['total'];
        break;
    }
  }
  
  $max_value = max(max($dukungan), max($tidakMendukung), max($netral));
  
  for ($i = 0; $i < count($labels); $i++) {
    if (!isset($dukungan[$i])) {
      $dukungan[$i] = 0;
    }
    if (!isset($tidakMendukung[$i])) {
      $tidakMendukung[$i] = 0;
    }
    if (!isset($netral[$i])) {
      $netral[$i] = 0;
    }
  }
  
  echo json_encode(array(
    'labels' => $labels,
    'dukungan' => $dukungan,
    'tidakMendukung' => $tidakMendukung,
    'netral' => $netral,
    'max_value' => $max_value
  ));
  mysqli_free_result($result);
  mysqli_close($conn);
  
?>