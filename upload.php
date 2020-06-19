<?php
if (!empty($_FILES["file"])) {
    $file = $_FILES["file"];
    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $parts = pathinfo($file['name']);
    $name = $parts["filename"] . "." . $parts["extension"];

    // if (file_exists("upload/" . $_POST["nama"])) {
    //     rmdir("upload/" . $_POST["nama"]);
    // }
    if (!file_exists("upload/" . $_POST["nama"])) {
        mkdir("upload/" . $_POST["nama"]);
        move_uploaded_file($file["tmp_name"], 'upload/' . $_POST['nama'] . '/' . $name);
        $dr = scandir("upload");
        $no = 1;
        foreach ($dr as $d) {
            if ($d == "." || $d == "..") continue;
            echo $no . ". " . $d . "<br/>";
            $no++;
        }
    } else {
        http_response_code(501);
    }
} else {
    http_response_code(502);
}
?>