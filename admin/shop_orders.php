<?php
include('../dbfunc.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updOrder($_POST['ordno']);
}

$orders = selectOrders();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5; url=shop_orders.php">
    <title>【公式】あなたの知らない揚げパンの世界</title>
    <!-- Bootstrap CSSの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container border border-3 border-primary bg-warning-subtle">
        <div class="row border border-3 border-info"><!-- ナビゲーションバー -->
            <?php readfile('../navbar.html') ?>
        </div>

        <div class="row border border-3 border-info">
            <div class="col-12 border border-3 border-success">
                <h1 class="p-2">商品を引き渡したらボタンを押す</h1>
            </div>
        </div>

        <div class="row border border-3 border-info">
            <table class="table table-warning table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>引き渡し日時</th>
                        <th>商品名</th>
                        <th>数量</th>
                        <th>名前</th>
                        <th>メール</th>
                        <th>引き渡したら押す</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $record) { ?>
                        <tr>
                            <td><?php echo $record['ODELIDATE'] ?></td>
                            <td><?php echo $record['PNAME'] ?></td>
                            <td><?php echo $record['OQUANTITY'] ?></td>
                            <td><?php echo $record['CNAME'] ?></td>
                            <td><?php echo $record['CMAIL'] ?></td>
                            <td>
                                <form action="shop_orders.php" method="POST">
                                    <input type="hidden" name="ordno" value="<?php echo $record['ORDNO']; ?>">
                                    <button type="submit" class="btn btn-primary">渡した</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>