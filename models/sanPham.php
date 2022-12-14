<?php

function sanPham_loadAll() {
    $sql = "select * from sanpham order by id";
    $listSP = pdo_query($sql);
    return $listSP;
}

function sanPham_loadThinhHanh($limit = 8) {
    $sql = "select * from sanpham order by luotXem desc limit $limit";
    $listSP = pdo_query($sql);
    return $listSP;
}

function sanPham_loadLienQuan($idLH, $limit = 5) {
    $sql = "select * from sanpham where idLoaiHang=$idLH order by luotXem desc limit $limit";
    $listSP = pdo_query($sql);
    return $listSP;
}

function sanPham_addOne($idLoaiHang, $tenSP, $hinh, $gia, $mota)
{
    $sql = "insert into sanpham(idLoaiHang, tenSanPham, hinh, gia, mota) values ('$idLoaiHang', '$tenSP', '$hinh', '$gia', '$mota')";
    pdo_execute($sql);
}

function sanPham_deleteOne($id)
{
    $sql = "delete from sanpham where id=" . $id;
    pdo_execute($sql);
}

function sanPham_tangLuotXem($id)
{
    $sql = "UPDATE sanpham SET luotXem = luotXem + 1 WHERE id=" . $id;
    pdo_execute($sql);
}

function sanPham_kTraDaMua($idNguoiDung, $idSanPham) {
    $sql = "select * from hoaDon, chitiethoadon where idNguoiDung='$idNguoiDung' and idSanPham='$idSanPham'";
    $result = pdo_query_one($sql);

    if (isset($result) && $result) {
        return true;
    }

    return false;
}

function sanPham_loadOne($id)
{
    $sql = "select * from sanpham where id=" . $id;
    $lh = pdo_query_one($sql);
    return $lh;
}

function sanPham_editOne($id, $tenSP, $idLoaiHang, $hinh, $gia, $moTa)
{
    $sql = "update sanpham set tenSanPham='$tenSP', idLoaiHang='$idLoaiHang', hinh='$hinh', gia='$gia', moTa='$moTa' where id=" . $id;
    pdo_execute($sql);
}

?>