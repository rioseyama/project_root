<?php
// データベース接続に使うユーザー名とパスワード（●●●はご自身の情報に置き換えてください）
$user = '●●●';
$pass = '●●●';

try {
    // データベースに接続（host=db はDocker環境などでよく使われるホスト名）
    $dbh = new PDO('mysql:host=db;dbname=recipe_db;charset=utf8', $user, $pass);

    // エラーが起きた場合に、例外（=キャッチできるエラー）を出すように設定
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // レシピテーブルから全てのデータを取得するSQL文
    $sql = 'SELECT * FROM recipes';

    // SQLを実行
    $stmt = $dbh->query($sql);

    // 結果を連想配列として取得（カラム名をキーとして使える）
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // HTMLのテーブルを開始
    echo '<table>' . PHP_EOL;

    // 表の見出し（カラム名）を作成
    echo '<tr>' . PHP_EOL;
    echo '<th>料理名</th><th>予算</th><th>難易度</th>' . PHP_EOL;
    echo '</tr>' . PHP_EOL;

    // 取得したデータ（レシピ1件ずつ）をテーブルの行として表示
    foreach ($result as $row) {
        echo '<tr>' . PHP_EOL;

        // 料理名を表示（HTMLエスケープで安全に出力）
        echo '<td>' . htmlspecialchars($row['recipe_name'], ENT_QUOTES) . '</td>' . PHP_EOL;

        // 予算を表示（HTMLエスケープ）
        echo '<td>' . htmlspecialchars($row['budget'], ENT_QUOTES) . '</td>' . PHP_EOL;

        // 難易度を数値から日本語に変換して表示（1=簡単, 2=普通, 3=難しい）
        echo '<td>' .
            match ($row['difficulty']) {
                1 => '簡単',
                2 => '普通',
                3 => '難しい',
            } . '</td>' . PHP_EOL;

        echo '</tr>' . PHP_EOL;
    }

    // テーブルを閉じる
    echo '</table>' . PHP_EOL;

    // データベース接続を終了
    $dbh = null;
} catch (PDOException $e) {
    // もしデータベース操作中にエラーが起きたらここでキャッチ（捕まえる）
    // エラーメッセージをHTMLエスケープして表示（安全対策）
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit; // 処理をここで終了
}
