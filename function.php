<?php

$conn = mysqli_connect("localhost","root","root","petshop");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function register($data){
    global $conn;

    $first_name = htmlspecialchars($data["first_name"]);
    $last_name = htmlspecialchars($data["last_name"]);
    $user_address = htmlspecialchars($data["user_address"]);
    $user_city = htmlspecialchars($data["user_city"]);
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $user_sex = htmlspecialchars($data["user_sex"]);

    //cek konfirmasi password
    if($password !== $password2){
        echo "
            <script>
                alert('Konfirmasi Password Tidak Sesuai');
                document.location.href='register.php';
            </script>
        ";

        return false;
    }

    // cek username
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    
    if( mysqli_fetch_assoc($result) ){
        echo "
            <script>
                alert('email sudah terdaftar!');
                document.location.href='register.php';
            </script>
        ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan data baru ke database
    $query = "INSERT INTO users VALUES
                ('','$first_name','$last_name','$user_address','$user_city','$email','$password',
                DEFAULT,'$user_sex',NOW())";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM products WHERE product_name LIKE '$keyword%'";

    return query($query);
}

function cariUser($keyword){
    $query = "SELECT * FROM users WHERE first_name LIKE '$keyword%' OR last_name LIKE '$keyword%'";

    return query($query);
}

function cariOrder($keyword){
    $query = "SELECT * FROM orders WHERE email LIKE '$keyword%'";

    return query($query);
}

function upload(){

    $namaFile = $_FILES['product_img_name']['name'];
    $ukuranFile = $_FILES['product_img_name']['size'];
    $error = $_FILES['product_img_name']['error'];
    $tmpName = $_FILES['product_img_name']['tmp_name'];

    //cek apa tidak ada gambar yang diupload
    if( $error === 4 ){
        echo "
                <script>
                    alert('Pilih Gambar Terlebih Dahulu!');
                </script>
            ";
        return false;
    }

    // cek gambar bener
    $ekstensiGambarValid = ['jpg','jpeg','png','gif','wav','bmp'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "
                <script>
                    alert('Yang di upload tidak sesuai ekstensi');
                </script>
            ";
        return false;
    }

    // cek ukuran 
    if( $ukuranFile > 5000000 ){
        echo "
                <script>
                    alert('size gambar terlalu besar');
                </script>
            ";
        return false;
    }

    // gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/products/' . $namaFileBaru);

    return $namaFileBaru;
}

function tambah($data){
    global $conn;

    $product_code = htmlspecialchars($data["product_code"]);
    $product_desc = htmlspecialchars($data["product_desc"]);
    $qty_product = htmlspecialchars($data["qty_product"]);
    $price_product = htmlspecialchars($data["price_product"]);
    $product_name = htmlspecialchars($data["product_name"]);
    $product_type = htmlspecialchars($data["product_type"]);

    // upload gambar
    $product_img_name = upload();
    if( !$product_img_name ){
        return false;
    }

    $query = "INSERT INTO products
                    VALUES
                ('', '$product_code', '$product_desc', '$product_img_name', '$qty_product',
                '$price_product', '$product_name', '$product_type', NULL)
            ";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;
    
    $productid = $data["productid"];
    $product_code = htmlspecialchars($data["product_code"]);
    $product_desc = htmlspecialchars($data["product_desc"]);
    $qty_product = htmlspecialchars($data["qty_product"]);
    $price_product = htmlspecialchars($data["price_product"]);
    $product_name = htmlspecialchars($data["product_name"]);
    $product_type = htmlspecialchars($data["product_type"]);
    $product_rating = htmlspecialchars($data["product_rating"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek user pilih gambar baru atau tidak
    if( $_FILES['product_img_name']['error'] === 4 ){
        $product_img_name = $gambarLama;
    } else {
        $product_img_name = upload();
    }

    $query = "UPDATE products SET
            product_code = '$product_code',
            product_desc = '$product_desc',
            product_img_name = '$product_img_name',
            qty_product = $qty_product,
            price_product = $price_product,
            product_name = '$product_name',
            product_type = '$product_type',
            product_rating = $product_rating
            WHERE productid = $productid
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM products WHERE productid = $id");
    return mysqli_affected_rows($conn);
}

?>