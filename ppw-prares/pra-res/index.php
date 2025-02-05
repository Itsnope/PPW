<?php
require_once 'config.php';
require_once 'generate_pdf.php';

function generateUniqueFilename($nama, $ext, $target_dir) {
    // Replace spaces with underscores and remove special characters
    $baseName = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', strtolower($nama)));
    
    // Check if file exists
    $counter = '';
    $filename = $baseName . $counter . $ext;
    
    while (file_exists($target_dir . $filename)) {
        if ($counter === '') {
            $counter = 1;
        } else {
            $counter++;
        }
        $filename = $baseName . $counter . $ext;
    }
    
    return $filename;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $target_dir = "uploads/";
        $foto = null;
        
        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
            // Get file extension
            $file_ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
            
            // Generate unique filename based on registrant's name
            $new_filename = generateUniqueFilename($_POST['nama'], '.' . $file_ext, $target_dir);
            
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $foto = $new_filename;
            }
        }

        $sql = "INSERT INTO registrasi_ssb (nama, tempat_lahir, tanggal_lahir, usia, 
                jenis_kelamin, nama_ortu, no_telp, alamat, rt, rw, desa, kecamatan, foto) 
                VALUES (:nama, :tempat_lahir, :tanggal_lahir, :usia, :jenis_kelamin, 
                :nama_ortu, :no_telp, :alamat, :rt, :rw, :desa, :kecamatan, :foto)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nama' => $_POST['nama'],
            ':tempat_lahir' => $_POST['tempat_lahir'],
            ':tanggal_lahir' => $_POST['tanggal_lahir'],
            ':usia' => $_POST['usia'],
            ':jenis_kelamin' => $_POST['jenis_kelamin'],
            ':nama_ortu' => $_POST['nama_ortu'],
            ':no_telp' => $_POST['no_telp'],
            ':alamat' => $_POST['alamat'],
            ':rt' => $_POST['rt'],
            ':rw' => $_POST['rw'],
            ':desa' => $_POST['desa'],
            ':kecamatan' => $_POST['kecamatan'],
            ':foto' => $foto
        ]);

        if ($stmt->rowCount() > 0) {
            // Add foto to $_POST array for PDF generation
            $_POST['foto'] = $foto;  // $foto is the filename that was saved
            // Generate PDF
            $pdfFilename = generatePDF($_POST);
            echo "<script>alert('Pendaftaran berhasil! PDF telah dibuat.');</script>";
        }
        
        echo "<script>alert('Pendaftaran berhasil!');</script>";
    } catch(PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran SSB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .alamat-group {
            display: grid;
            grid-template-columns: 1fr 0fr 1fr;
            gap: 10px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">FORMULIR PENDAFTARAN SSB</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>

        <div class="form-group">
            <label for="usia">Usia:</label>
            <input type="number" id="usia" name="usia" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nama_ortu">Nama Orang Tua:</label>
            <input type="text" id="nama_ortu" name="nama_ortu" required>
        </div>

        <div class="form-group">
            <label for="no_telp">No Telp/HP:</label>
            <input type="text" id="no_telp" name="no_telp" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <div class="alamat-group">
            <div class="form-group">
                <label for="rt">RT:</label>
                <input type="text" id="rt" name="rt" required>
            </div>
            <div></div>
            <div class="form-group">
                <label for="rw">RW:</label>
                <input type="text" id="rw" name="rw" required>
            </div>
        </div>

        <div class="form-group">
            <label for="desa">Desa:</label>
            <input type="text" id="desa" name="desa" required>
        </div>

        <div class="form-group">
            <label for="kecamatan">Kecamatan:</label>
            <input type="text" id="kecamatan" name="kecamatan" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto (4x6):</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
        </div>

        <button type="submit" class="submit-btn">Daftar</button>
    </form>
</body>
</html>