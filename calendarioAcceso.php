<?php
session_start();
require_once('calendarioAjustes.php');

$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>

<head>

    <meta http-equiv='refresh' content='0; URL=<?= $login_url ?>'>

</head>
<body>
</body>
