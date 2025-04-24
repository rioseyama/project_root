<?php
print_r($_POST);
// 'recipe_name'をHTMLエスケープして出力
echo htmlspecialchars($_POST['recipe_name'], ENT_QUOTES);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>出力結果</title>
</head>

<body>
    <?php
    // ユーザーの入力データをセキュアに表示
    echo htmlspecialchars($_POST['recipe_name'], ENT_QUOTES);
    echo '<br>';

    // カテゴリーに応じて出力を変更
    if ($_POST['category'] == '1') echo '和食';
    if ($_POST['category'] == '2') echo '中華';
    if ($_POST['category'] == '3') echo '洋食';
    echo '<br>';

    // 難易度に応じて出力を変更
    if ($_POST['difficulty'] == '1') {
        echo '簡単';
    } elseif ($_POST['difficulty'] == '2') {
        echo '普通';
    } else {
        echo '難しい';
    }
    echo '<br>';
    ?>

<?php
    // ユーザーの入力データをセキュアに表示
    echo htmlspecialchars($_POST['recipe_name'], ENT_QUOTES);
    echo '<br>';
    
    // match式を使ったカテゴリーの判定
    echo match ($_POST['category']) {
        '1' => '和食',
        '2' => '中華',
        '3' => '洋食',
        default => '不明',
    } . '<br>';
    
    // match式を使った難易度の判定
    echo match ($_POST['difficulty']) {
        '1' => '簡単',
        '2' => '普通',
        '3' => '難しい',
    } . '<br>'; 

    if (is_numeric($_POST['budget'])) {
        echo number_format($_POST['budget']);
    } else {
        echo 'エラー: 数字を入力してください';
    }
    echo '<br>';
    

    if (is_numeric($_POST['budget'])) {
        echo number_format($_POST['budget']);
    } else {
        echo 'エラー: 数字を入力してください';
    }
    echo '<br>';


    ?>
</body>

</html>