<?php
function nguoiDung_loadAll()
{
    $sql = "select * from taikhoan order by id";
    $listND = pdo_query($sql);
    return $listND;
}

function nguoiDung_addOne($tenTaiKhoan, $matKhau, $email, $soDienThoai, $vaiTro, $hinh)
{
    $sql = "insert into nguoidung(tenTaiKhoan, matKhau, email, soDienThoai, vaiTro, hinh) values ('$tenTaiKhoan', '$matKhau', '$email', '$soDienThoai', '$vaiTro', '$hinh')";
    pdo_execute($sql);
}

function nguoiDung_loadOne($id)
{
    $sql = "select * from nguoidung where id=" . $id;
    $nd = pdo_query_one($sql);
    return $nd;
}

?>