<?php

function dbConnect()
{
    $host = 'localhost';
    $dbname = 'seminar2db';
    $username = 'root';
    $password = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function selectProducts()
{
    $pdo = dbConnect();
    try {
        $stmt = $pdo->prepare("SELECT * FROM PRODUCTS ORDER BY PCODE");
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $products = [];
    $i = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $products[$i] = [
            'pcode' => $row['pcode'],
            'pname' => $row['pname'],
            'pdesc' => $row['pdesc'],
            'pprice' => $row['pprice'],
            'pfilename' => $row['pfilename']
        ];
        $i++;
    }
    return $products;
}

function insOrder($data)
{
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT COALESCE(MAX(ORDNO), 0) + 1 AS newordno FROM orders");
    $stmt->execute();
    $newordno = $stmt->fetch(PDO::FETCH_ASSOC)['newordno'];

    $stmt = $pdo->prepare("INSERT INTO ORDERS (ORDNO, ORDDATE, PCODE, QUANTITY, ODELIDATE, OACTDELIDATE, CNAME, CMAIL) VALUES (:ordno, SYSDATE(), :pcode, :oquantity, :odelidate, NULL, :cname, :cmail)");

    $stmt->bindValue(':ordno', $newordno, PDO::PARAM_INT);
    $stmt->bindValue(':pcode', $data['pcode'], PDO::PARAM_STR);
    $stmt->bindValue(':oquantity', $data['oquantity'], PDO::PARAM_INT);
    $stmt->bindValue(':odelidate', $data['odelidate'], PDO::PARAM_STR);
    $stmt->bindValue(':cname', $data['cname'], PDO::PARAM_STR);
    $stmt->bindValue(':cmail', $data['cmail'], PDO::PARAM_STR);

    $stmt->execute();
}

function selectOrders()
{
    $pdo = dbConnect();
    try {
        $stmt = $pdo->prepare("SELECT ORDNO,PNAME,OQUANTITY,ODELIDATE,CNAME,CMAIL FROM ORDERS INNER JOIN PRODUCTS USING(PCODE) WHERE OACTDELIDATE IS NULL ORDER BY ODELIDATE,ORDNO ");
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updOrder($ordno)
{
    $pdo = dbConnect();
    try {
        $stmt = $pdo->prepare("UPDATE ORDERS SET OACTDELIDATE = SYSDATE() WHERE ORDNO = :ordno");
        $stmt->bindValue(':ordno', $ordno, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
