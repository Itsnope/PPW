<?php
require 'config.php';

if(isset($_GET['id'])) {
    $kode = $_GET['id'];

    $query = "SELECT * FROM salad WHERE kode_salad = '$kode'";
    $result = mysqli_query($connect, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Jika data ditemukan, lakukan delete
        $delete_query = "DELETE FROM salad WHERE kode_salad = '$kode'";
        
        if (mysqli_query($connect, $delete_query)) {
            // Set a success flash message
            session_start();
            $_SESSION['flash'] = '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>';
        } else {
            // Set an error flash message
            session_start();
            $_SESSION['flash'] = '<div class="alert alert-danger" role="alert">Gagal menghapus data: ' . mysqli_error($connect) . '</div>';
        }
    } else {
        // Set an error flash message if user not found
        session_start();
        $_SESSION['flash'] = '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>';
    }
} else {
    // Set an error flash message if no ID provided
    session_start();
    $_SESSION['flash'] = '<div class="alert alert-danger" role="alert">ID tidak valid!</div>';
}

// Redirect back to the main page
header("Location: " . $WEB_CONFIG['base_url'] . "index.php");
exit();
?>