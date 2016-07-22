<?php

class Advertising
{
    public static function getAdvertising()
    {
        $db = DB::getConnection();
        $sql = $db->query('SELECT * FROM advertising ORDER BY views DESC');
        $i = 0;
        $advertising = [];
        while($row = $sql->fetch()) {
            $advertising[$i]['id_advertising'] = $row['id_advertising'];
            $advertising[$i]['product_name'] = $row['product_name'];
            $advertising[$i]['price'] = $row['price'];
            $advertising[$i]['company'] = $row['company'];
            $advertising[$i]['views'] = $row['views'];
            $i++;
        }
        return $advertising;
    }

    public static function getCurrentAdvertising($advertisingId){
        $db = DB::getConnection();
        $sql = $db->query('SELECT * FROM advertising WHERE id_advertising = ' . $advertisingId);
        return $sql->fetch();
    }

    public static function updateViews($advertisingId, $views)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE advertising SET views = $views WHERE id_advertising = $advertisingId");
        if($sql){
            return true;
        } else {
            return false;
        }
    }

    public static function addAdvertising($productName, $price, $company)
    {
        $db = DB::getConnection();
        $sql = $db->query("INSERT INTO advertising (product_name, price, company, views) VALUES ('$productName', $price, '$company', 0)");
        if($sql){
            return true;
        } else {
            return false;
        }
    }

    public static function updateAdvertising($advertisingId, $productName, $price, $company)
    {
        $db = DB::getConnection();
        $sql = $db->query("UPDATE advertising SET product_name = '$productName', price = $price, company = '$company' WHERE id_advertising = $advertisingId");
        if($sql){
            return true;
        } else {
            return false;
        }
    }

    public static function deleteAdvertising($advertisingId)
    {
        $db = DB::getConnection();
        $sql = $db->query("DELETE FROM advertising WHERE id_advertising = $advertisingId");
        print_r( $sql)  ;
        if($sql){
            return true;
        } else {
            return false;
        }
    }
}