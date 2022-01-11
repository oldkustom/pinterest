<?php
require_once "usernames.php";
$count_user = count($alluser);
$count_404 = 0;
foreach ($alluser as $user) {
    $ch = curl_init($user);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpcode == 404) {
        echo "### ".$user."\n";
        echo "- HTTP code: ".$httpcode."\n";
        echo "++++++++\n";
        $count_404++;
    }
    sleep(rand(1, 2));
}
$count_200 =  $count_user - $count_404;
echo $count_200." of ".$count_user."\n";
?>
