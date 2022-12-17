<?php
    include 'connect.php';
    session_start();
    if(!isset($_COOKIE['login_session_key']) && !isset($_SESSION['userId'])){
        header('Location: login.php');
    }
    $userId = $_SESSION['userId'];
    $profileId = $_GET['userId'];

    $sql = "SELECT nickname FROM `users` WHERE id='$userId'";
    $result = mysqli_query($conn, $sql);
    if($result){
      $row = mysqli_fetch_assoc($result);
      $nickname = $row['nickname'];
    }else if(!$result){
      header('Location: welcome.php');
    }

    $sql = "SELECT nickname FROM `users` WHERE id='$profileId'";
    $result = mysqli_query($conn,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $profileNickname = $row['nickname'];
        if($profileNickname == null){
            header('Location: welcome.php');
        }
        echo '<script>
                document.title = "Perfil de ' . $profileNickname . '"; 
            </script>';
    }else if (!$result){
        header('Location: welcome.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1 class="logo-link">
            <a href="welcome.php">
                Pagina inicial
            </a>
        </h1>
        <div class="icons">
                <svg onclick="hideNotifications()" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title>ionicons-v5-j</title><path d="M440.08,341.31c-1.66-2-3.29-4-4.89-5.93-22-26.61-35.31-42.67-35.31-118,0-39-9.33-71-27.72-95-13.56-17.73-31.89-31.18-56.05-41.12a3,3,0,0,1-.82-.67C306.6,51.49,282.82,32,256,32s-50.59,19.49-59.28,48.56a3.13,3.13,0,0,1-.81.65c-56.38,23.21-83.78,67.74-83.78,136.14,0,75.36-13.29,91.42-35.31,118-1.6,1.93-3.23,3.89-4.89,5.93a35.16,35.16,0,0,0-4.65,37.62c6.17,13,19.32,21.07,34.33,21.07H410.5c14.94,0,28-8.06,34.19-21A35.17,35.17,0,0,0,440.08,341.31Z"/><path d="M256,480a80.06,80.06,0,0,0,70.44-42.13,4,4,0,0,0-3.54-5.87H189.12a4,4,0,0,0-3.55,5.87A80.06,80.06,0,0,0,256,480Z"/></svg>
                <svg onclick="hideDropdown()" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 459 459" style="enable-background:new 0 0 459 459;" xml:space="preserve"><g><g><path d="M229.5,0C102.53,0,0,102.845,0,229.5C0,356.301,102.719,459,229.5,459C356.851,459,459,355.815,459,229.5 C459,102.547,356.079,0,229.5,0z M347.601,364.67C314.887,393.338,273.4,409,229.5,409c-43.892,0-85.372-15.657-118.083-44.314 c-4.425-3.876-6.425-9.834-5.245-15.597c11.3-55.195,46.457-98.725,91.209-113.047C174.028,222.218,158,193.817,158,161c0-46.392,32.012-84,71.5-84c39.488,0,71.5,37.608,71.5,84c0,32.812-16.023,61.209-39.369,75.035c44.751,14.319,79.909,57.848,91.213,113.038C354.023,354.828,352.019,360.798,347.601,364.67z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            <?php
                echo '<p style="margin-top:0.5rem;" class="navbarNickname">' . $nickname . '</p>';
            ?>
        </div>
    </div>
    <div class="body">
        <div class="perfil" style="border-radius: 1.5rem;">
            <div id="iconPerfil">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 459 459" style="enable-background:new 0 0 459 459;" xml:space="preserve"><g><g><path d="M229.5,0C102.53,0,0,102.845,0,229.5C0,356.301,102.719,459,229.5,459C356.851,459,459,355.815,459,229.5 C459,102.547,356.079,0,229.5,0z M347.601,364.67C314.887,393.338,273.4,409,229.5,409c-43.892,0-85.372-15.657-118.083-44.314 c-4.425-3.876-6.425-9.834-5.245-15.597c11.3-55.195,46.457-98.725,91.209-113.047C174.028,222.218,158,193.817,158,161c0-46.392,32.012-84,71.5-84c39.488,0,71.5,37.608,71.5,84c0,32.812-16.023,61.209-39.369,75.035c44.751,14.319,79.909,57.848,91.213,113.038C354.023,354.828,352.019,360.798,347.601,364.67z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </div>
            <div style="margin-top:0.5rem; text-align: center; margin-top: 1.5rem" class="nomePerfil">
                <?php
                echo '<h2 class="navbarNickname">' . $profileNickname . '</h2>';
                $sql = "SELECT * FROM seguidores WHERE pessoa = '$userId' AND seguiu = '$profileId'";
                $result = mysqli_query($conn,$sql);

                if($_SESSION['userId'] == $_GET['userId']){
                    echo '<a href="welcome.php">
                        <input class="btnSubmit" type="submit" value="Editar perfil">
                      </a>';
                }else if(!$result){
                    echo '<a href="follow.php?followId=' . $profileId . '">
                            <input class="btnSubmit" type="submit" value="Seguir"/>
                          </a>';
                }else{
                    echo '<a href="unfollow.php?unfollowId=' . $profileId . '">
                            <input class="btnSubmit" style="background-color: gray" type="submit" value="Deixar de seguir"/>
                          </a>';
                }
                ?>
            </div>
            <p style="margin-top: 1rem">Descrição do utilizador</p>
            <?php
            //contar todos os seguidores do utilizador
            $sql = "SELECT COUNT(*) AS total FROM seguidores WHERE seguiu = '$profileId'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $totalFollowers = $row['total'];
            echo '<p style="margin-top: 0.5rem">' . $totalFollowers . ' seguidores</p>';

            //contar todos as pessoas que o utilizador segue
            $sql = "SELECT COUNT(*) AS total FROM seguidores WHERE pessoa = '$profileId'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $totalFollowing = $row['total'];
            echo '<p style="margin-top: 0.5rem">' . $totalFollowing . ' seguindo</p>';
            ?>
            <p style="margin-bottom: 1rem; margin-top: 1rem"><b>Titulos</b></p>
            <div class="titulos">
                <?php
                //mostrar os titulos do utilizador
                $sql = "SELECT * FROM titulos WHERE user = '$profileId'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $titulo = $row['titulo'];
                    if($titulo == "admin"){
                        echo '<p id="tituloAdmin">Admin</p>';
                    }else if($titulo == vip){
                        echo '<p id="tituloVip">V.I.P</p>';
                    }
                }
                ?>
                <p id="tituloMembro">Membro</p>
            </div>
        </div>

        <div class="followsModal">
            <div class="followsModalContent">
                <div class="followsModalContentHeader">
                    <p>Seguindo</p>
                </div>
                <div class="followsModalContentBody">
                    <?php
                    $sql = "SELECT * FROM `seguidores` WHERE pessoa='$profileId'";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $followingId = $row['seguiu'];
                        $sql = "SELECT * FROM `users` WHERE id='$followingId'";
                        $result2 = mysqli_query($conn, $sql);
                        $row2 = mysqli_fetch_assoc($result2);
                        $nickname = $row2['nickname'];
                        echo '<div class="followsModalContentBodyUser">';
                        echo '<a href="profile.php?userId=' . $followingId . '">';
                        echo '<div class="followsModalContentBodyUserProfilePicture">';
                        echo '</div>';
                        echo '<div class="followsModalContentBodyUserNickname">';
                        echo '<p>' . $nickname . '</p>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="dropdowns">
            <div id="notifications" class="dropdownNotifications" style="visibility: hidden;">
                <?php
                $sql = "select * from `notifications` where usernotificado='" . $_SESSION['userId'] . "'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $idSess = $_SESSION['userId'];
                    $sql1 = "SELECT notifications.idNoti, users.utilizador, notifications.notificou, actions.Action, notifications.idAction, users.id FROM ((notifications INNER JOIN users ON notifications.notificou = users.id) INNER JOIN actions ON notifications.idAction = actions.idAction) WHERE notifications.userNotificado ='$idSess'";
                    $result1 = mysqli_query($conn, $sql1);
                    if($result1) {
                        while ($row = mysqli_fetch_array($result1)) {
                            $utilizador = $row['utilizador'];
                            $acao = $row['Action'];
                            if ($acao == 'Começou_a_seguir') {
                                echo $utilizador . 'começou a seguir te';
                            }
                        }
                    }
                }else{
                    echo '<b>Não existem notificações disponíveis</b> ';
                }
                ?>
            </div>
            <div id="dropdown" class="dropdownPerfil" style="visibility: hidden;">
                <ul style="list-style-type: none;">
                    <li><a href="<?php echo 'profile.php?userId=' . $_SESSION['userId'] ?>">Perfil</a></li>
                    <div class="separador"></div>
                    <li><a href="<?php echo 'settings.php'?>">Settings</a></li>
                    <div class="separador"></div>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

<script>

    function hideDropdown(){
        var dropdownPerfil = document.getElementById('dropdown');
        var notifications = document.getElementById('notifications');
        if(dropdownPerfil.style.visibility == "hidden"){
            dropdownPerfil.style.visibility = "visible";
        }else{
            dropdownPerfil.style.visibility = "hidden";
        }

        if(notifications.style.visibility == "visible"){
            notifications.style.visibility = "hidden";
        }
    }

    function hideNotifications(){
        var dropdownPerfil = document.getElementById('dropdown');
        var notifications = document.getElementById('notifications');
        if(notifications.style.visibility == "hidden"){
            notifications.style.visibility = "visible";
        }else{
            notifications.style.visibility = "hidden";
        }

        if(dropdownPerfil.style.visibility == "visible"){
            dropdownPerfil.style.visibility = "hidden";
        }
    }

</script>