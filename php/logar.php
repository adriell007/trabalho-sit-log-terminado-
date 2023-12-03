<?php
include('login.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {

        $login_usu = $sql_query->fetch_assoc();

        if (!isset($_SESSION)) {
            session_start();
        }

        header("Location: telaconclusao.php");
        exit(); // Certifique-se de sair após o redirecionamento para evitar execução adicional de código

    } else {
        $mensagem = "E-mail ou senha incorretos";
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="icone.png">
</head>
<style>
/* Esté é o menu em cima */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500&display=swap');
* {
    padding: 0;
    margin: 0;
    font-family: 'Inter', sans-serif;
}

header {
    background-color: #f8f8f8;
    box-shadow: 0px 5px 10px #ffa600;
}

.nav-bar {
    display: flex;
    justify-content: space-between;
    padding: 1.5rem 6rem;
    margin-top: -10px;
}

.logo {
    display: flex;
    align-items: center;
    margin-top: 22px;
}


.nav-list {
    display: flex;
    align-items: center;
}

.nav-list ul {
    display: flex;
    justify-content: center;
    list-style: none;
}

.nav-item {
    margin: 50px;
}

.nav-link {
    text-decoration: none;
    font-size: 25px;
    color: rgb(255, 145, 2);
    font-weight: 400;
}

.login-button button {
    margin-top: 46px;
    border: none;
    padding: 10px 30px;
    border-radius: 100px;
    background-color: #ff9204;
}

.login-button button a {
    text-decoration: none;
    color: #ffffff;
    font-size: 20px;
}

.mobile-menu-icon {
    display: none;
}

.mobile-menu {
    display: none;
}

.container{
    background-color: #fff;

    box-shadow: 0 5px 15px  rgb(255, 145, 2);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
    margin-left: 20%;
    margin-top: 70px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background-color: rgb(255, 145, 2);
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: rgb(255, 255, 255);;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: rgb(255, 145, 2);
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.form-container span{
    margin-top: -10px;
}

.form-container button input{
    opacity: 1;
    margin-top: -11px;
    width: 150px;
    margin-left: -46px;
    height: 30px;
    background-color:  rgb(255, 145, 2);
    color: rgb(255, 255, 255);
    font-size: 10px;
}
.form-container button{
    width: 150px;
    height: 30px;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}

.social-icons{
    margin: 20px 0;
    margin-top: -10px;
}

.social-icons a{
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}


.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 10px 0 0 10px;
    z-index: 1000;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 10px 10px 0;
}

.toggle{
    background-color: #512da8;
    height: 100%;
    background: linear-gradient(to right,  rgb(255, 145, 2),  rgb(255, 145, 2));
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle{
    transform: translateX(50%);
}

.toggle-panel{
    position: absolute;
    width: 40%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left{
    transform: translateX(-200%);
}

.container.active .toggle-left{
    transform: translateX(0);
}

.toggle-right{
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right{
    transform: translateX(200%);
}
.retangulo2{
    margin-top: 400px;
    width: 100%;
    height: 300px;
    background-color: #ff9204;
}
#logoDb{
    width: 200px;
    height: 70px;
    margin: 20px;
    margin-top: 20px;
}
.itensDb{
    display: flex;
    margin-top: 100px;
    margin-left: 150px;
}

.itensDb2{
    margin-left: 210px;
    margin-top: 50px;
}

.fa{
    margin-top: 50px;
    margin: 10px;
}

#insta{
    display: flex;
    margin-top: 60px;
    margin-left: 100px;
}
#face{
    margin-top: 60px;
}
#you{
    margin-top: 60px;
}
.txDb1{
    margin-left: 480.5px;
    margin-top: -75px;
    color: white;
}    
.txDb2{
    margin-left: 795px;
    margin-top: -17px;
    color: white;
}
.txDb3{
    width: 200px;
    font-size: 10px;
    margin-left: 480.5px;
    margin-top: 30px;
    color: white;
    word-break: break-all;
}
.txDb4{
    width: 200px;
    font-size: 10px;
    margin-left: 800.5px;
    margin-top: -49px;
    color: white;
    word-break: break-all;
}
.txDb5{
    text-align: center;
    font-size: 10px;
    margin-top: 100px;
    color: white;
   
}
@media screen and (max-width: 730px){
    .nav-bar {
        padding: 1rem 4rem;
    }
    .nav-item {
        display: none;
    }
    .login-button {
        display: none;
    }
    .mobile-menu-icon {
        display: block;
        margin-top: 30px;
    }
    .mobile-menu-icon button {
        background-color: orange;
        border: none;
        cursor: pointer;
    }
    .mobile-menu ul {
        display: flex;
        flex-direction: column;
        text-align: center;
        padding-bottom: 1rem;
    }
    .mobile-menu .nav-item {
        display: block;
        padding-top: 1px;
    }
    .mobile-menu .login-button {
        display: block;
        padding: 1rem 2rem;
    }
    .mobile-menu .login-button button {
        width: 100%;
    }
    .open {
        display: block;
    }
    .nav-link{
        font-size: 10px;  
    }
    .nav-item{
        margin: 5px;
    }
    .login-button button{
        margin-top: -100px;
        
        
    }
    .tmBt{
        font-size: 10px;
    }
    .retangulo2{
        margin-top: 250px;
        width: 100%;
        height: 220px;
        background-color: #ff9204;
    }
    #logoDb{
        width: 100px;
        height: 30px;
        margin-left: -100px;
        margin-top: 20px;
    }
    .itensDb{
        font-size: 12px;
        display: flex;
        margin-top: 100px;
        margin-left: 100px;
    }
    
    .itensDb2{
        font-size: 12px;
        margin-left: -250px;
        margin-top: 50px;
    }
    
    .fa{
        margin-top: 50px;
        margin: 10px;
    }
    
    #insta{
        display: flex;
        margin-top: 60px;
        margin-left: 100px;
    }
    #face{
        margin-top: 60px;
    }
    #you{
        margin-top: 60px;
    }
    .txDb1{
        font-size: 8px;
        margin-left: 58px;
        margin-top: -35px;
        color: white;
    }    
    .txDb2{
        font-size: 8px;
        margin-left: 235px;
        margin-top: -9px;
        color: rgb(255, 255, 255);
    }
    .txDb3{
        width: 150px;
        font-size: 8px;
        margin-left: 15px;
        margin-top: 30px;
        color: white;
        word-break: break-all;
    }
    .txDb4{
        width: 150px;
        font-size: 8px;
        margin-left: 190px;
        margin-top: -40px;
        color: white;
        word-break: break-all;
    }
    .txDb5{
        text-align: center;
        font-size: 8px;
        margin-top: 60px;
        color: white;
       
    }
    
    .container{
        margin-top: 20px;
        font-size: 10px;
        width: 400px;
        height: 50px;
        margin-left: 0px;
    }
    .container button{
    background-color: #512da8;
    color: #fff;
    font-size: 8px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
    }
}

</style>
<body>
<span class="todo">
<div class="navbar"></div>
<header>
        <div class="linha1"></div>
        <nav class="nav-bar">
            <div class="logo">
                <img src="logo.png" alt="">
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="pag1.html" class="nav-link">HOME</a></li>
                    <li class="nav-item"><a href="pag2.html" class="nav-link">EMPRESA</a></li>
                    <li class="nav-item"><a href="pag3.html" class="nav-link">RASTREIO</a></li>
                </ul>
            </div>
            <div class="login-button">
                <button><a href="logar.php">LOGIN</a></button>
            </div>

            <div class="mobile-menu-icon">
                <button onclick="menuShow()"><img class="icon" src="menu_white_36dp.svg" alt=""></button>
            </div>
        </nav>
        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="pag1.html" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="pag2.html" class="nav-link">EMPRESA</a></li>
                <li class="nav-item"><a href="pag3.html" class="nav-link">RASTREIO</a></li>
            </ul>

            <div class="login-button">
                <button><a href="logar.php"><p class="tmBt">LOGIN</p></a></button>
            </div>
        </div>
    </header>   
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="logar.php" method="post" onsubmit="return validarFormulario_2()">
                <h1>Criar Conta</h1>
                <span>Preencha os requisitos abaixo.</span>
                <input type="text" name="nome" id="nome" placeholder="Name:">
                <input type="text" name="cpf" id="cpf" placeholder="CPF:">
                <input type="text" name="telefone" id="telefone"  placeholder="Telefone:">
                <input type="email" name="email" id="email"  placeholder="Email:">
                <input type="password" name="senha" id="senha"  placeholder="Senha:">
                <button><input name="submit" type="submit" id="submit"></button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="logar.php" method="post" onsubmit="return validarFormulario()">
                <h1>Entre na sua Conta</h1><BR></BR>
                <span>Use seu email e senha para logar.</span>
                <?php
                
                if (isset($mensagem)) {
                    echo "<p>$mensagem</p>";
                }
                ?>
                <input type="email" id="email" name="email" placeholder="Email:">
                <input type="password" id="senha" name="senha" placeholder="Senha:">
                <a href="#">Esqueceu sua senha?</a>
                <button><input name="submit" type="submit" id="submit"></button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Como é bom ver você de volta!</h1>
                    <p>Conecte-se na sua conta para receber nossas notificações.</p>
                    <button class="hidden" id="login">Logar na minha conta</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Como é bom você de volta</h1>
                    <p>entre na sou aconta para ver as novidades.</p>
                    <a href="cadastra.php"><button class="hidden" id="register">Cadastre-se</button></a>
                </div>
            </div>
        </div>
    </div>
<script>
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
</script>
<div class="retangulo2">
        <div class="itensDb">
            <img src="logo.png" id="logoDb">
            <div class="itnsDb1"></div>
            <i class="fa fa-instagram" aria-hidden="true" id="insta"></i>
            <i class="fa fa-facebook-square" aria-hidden="true" id="face"></i>
            <i class="fa fa-youtube-play" aria-hidden="true" id="you"></i>
            
            <div class="itensDb2">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
            <i class="fa fa-envelope" aria-hidden="true"></i>
        
            </div>
        </div>
        <p class="txDb1">REDES SOCIAIS</p><p class="txDb2">CONTATO</p>

        <p class="txDb3">Razão Social: LOGEXPRESS Transportadora LTDACNPJ: 77.888.999/0001-10 <br><br> Endereço Rua 13, 628 – Maracanaú/CE</p><p class="txDb4">Email 
            comercial@logexpress.com.br <br> <br>         
            Segunda a Sexta: 09:00h às 18:00hSábados: 09:00h às 12:00h</p>
            <p class="txDb5">2023 - Todos os direitos reservados – Produzido por estudantes</p>
    </div>



</body>
</html>