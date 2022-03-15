<?php
  include 'connect.php';
  session_start();
  if(isset($_COOKIE['login_session_key'])){
    $login_session_key = $_COOKIE['login_session_key'];
    $sql = "SELECT * FROM `users` WHERE login_session_key='$login_session_key'";
    $result = mysqli_query($conn, $sql);
    if($result){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['userId'] = $row['id'];
      $_SESSION['admin'] = $row['admin'];
      header('Location: welcome.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-900">
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
      <h2 class="mt-6 text-center text-3xl font-extrabold text-stone-50">Login</h2>
    </div>
    <form class="mt-8 space-y-6" method="POST">
      <input type="hidden" name="remember" value="true">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email-address" class="sr-only">Email address or Username</label>
          <input id="email-address" name="user" type="text" autocomplete="email" required class="bg-transparent appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-stone-50 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address or Username">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="psw" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 bg-transparent placeholder-gray-500 text-stone-50 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="rememberme" name="rememberme" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-stone-50"> Remember me </label>
        </div>

        <div class="text-sm">
          <a href="#" class="font-medium text-stone-100 hover:text-indigo-500"> Forgot your password? </a>
        </div>
      </div>

      <div>
        <button name="submit" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-violet-900 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </span>
          Sign in
        </button>
      </div>
    </form>
  </div>
</div>
</body>
</html>

<?php
    if(isset($_POST["submit"])){
        $user = $_POST['user'];
        $pass = md5($_POST['psw']);
        if(empty($user) || empty($pass)){
            $erro = "Todos os campos devem ser preenchidos.";
            echo "<br><span class='erro' style='margin-top: 20px;'>$erro</span>";
            return;
        }
         $sql = "SELECT * FROM `users` WHERE user='$user' OR email='$user' AND pass ='$pass' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                if($user == $row['user'] && $pass == $row['pass'])
                $_SESSION['userId'] = $row['id'];
                $_SESSION['admin'] = $row['admin'];
                if($_POST['rememberme'] == true){
                  $key = '';
                  $array = array('A','B','C','D','E','F','G','H','I','K','L','M','N','O','P','Q','R','S','T','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
                  for($i = 0; $i < 30; $i++){
                      $key .= $array[rand(0, count($array))];
                  }
                  $sql = "SELECT * FROM `users` WHERE login_session_key='$key'";
                  $result = mysqli_query($conn, $sql);
                  if($result){
                    $key = '';
                    $array = array('A','B','C','D','E','F','G','H','I','K','L','M','N','O','P','Q','R','S','T','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
                    for($i = 0; $i < 30; $i++){
                        $key .= $array[rand(0, count($array))];
                    }
                  }
                  $sql = "UPDATE `users` SET login_session_key='$key' WHERE user='$user'";
                  $result = mysqli_query($conn, $sql);
                  setcookie('login_session_key',$key,time() + (86400 * 3));
                }
                header('Location: welcome.php');
            }else{
                $erro = "Utilizador ou palavra-passe incorreto/a.";
                echo "<br><span class='erro' style='margin-top: 20px;'>$erro</span>";
                return;
            }
    }
?>