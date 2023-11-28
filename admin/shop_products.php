<?php
include('../dbfunc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['mode'] === 'insert') {
        $pdata = [
            'pcode' => $_POST['pcode'],
            'pname' => $_POST['pname'],
            'pdesc' => $_POST['pdesc'],
            'pprice' => $_POST['pprice'],
            'pfilename' => $_POST['pfilename']
        ];
        insProduct($pdata);
    } else if ($_POST['mode'] === 'update') {
        $pdata = [
            'pcode' => $_POST['pcode'],
            'pname' => $_POST['pname'],
            'pdesc' => $_POST['pdesc'],
            'pprice' => $_POST['pprice'],
            'pfilename' => $_POST['pfilename']
        ];
        // updProduct($pdata);
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>【公式】あなたの知らない揚げパンの世界</title>
    <!-- Bootstrap CSSの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container border border-3 border-primary bg-warning-subtle">
        <div class="row border border-3 border-info">
            <!-- ナビゲーションバー -->
            <?php readfile('../navbar.html') ?>
        </div>
        <div class="row border border-3 border-info">
            <div class="col-12 border border-3 border-success">
                <h1 class="p-2">更新するか登録するかはあなた次第</h1>
            </div>
        </div>
        <div class="row border border-3 border-info p-5">
            <form action="shop_products.php" method="POST">
                <input type="hidden" name="mode" value="insert">
                <label for="pcode">商品コード（半角4桁）</label>
                <input type='text' class="form-control" name='pcode' id="pcode">
                <label for="pname">商品名</label>
                <input type='text' class="form-control" name='pname' id="pname">
                <label for="pdesc">商品概要</label>
                <textarea class="form-control" name="pdesc" id="pdesc" rows="3"></textarea>
                <label for="pprice">商品単価</label>
                <input type='text' class="form-control" name='pprice' id="pprice">
                <label for="pfilename">ファイル名</label>
                <input type='text' class="form-control" name='pfilename' id="pfilename" style="margin-bottom: 15px;">
                <button type="submit" class="btn btn-primary">新規登録</button>
            </form>
        </div>
        <div class="row border border-3 border-info table-responsive">
            <table class="table table-warning table-striped table-hover align-top" aria-describedby="table-description">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>商品概要</th>
                        <th>商品単価</th>
                        <th>商品イメージ</th>
                        <th>更新</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $record) { ?>
                        <tr class="p-2">
                            <form action="shop_products.php" method="POST">
                                <input type="hidden" name="mode" value="update">
                                <td>
                                    <button type="submit" class="btn btn-primary">更新</button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JavaScriptの読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>