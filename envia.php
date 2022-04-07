<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST)){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $end = $_POST['end'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $msg = $_POST['mensagem'];
    $mensagem = nl2br($msg);

    $enviaFormularioParaNome = "Formulario de Contato - Site";
$enviaFormularioParaEmail = "atendimento@packtell.com.br";
 
$caixaPostalServidorNome = 'Packtell - A Casa das Embalagens';
$caixaPostalServidorEmail = 'site@packtell.com.br';
$caixaPostalServidorSenha = 'IEM505044mac';
 
/*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/ 
 
 
/* abaixo as veriaveis principais, que devem conter em seu formulario*/
 $cliente = $nome;
$tentativa = $dados['tentativa'];
$nomecurso = $dados_curso['nome'];
           
 $mensagem = '<div style="width: 100%; background-color: gainsboro;">
<h1>Mensagem enviada por site Packtell.com.br.</h1>    
<h5>Cliente: '.$nome.' <br>Email: '.$email.'<br>Telefone: '.$tel.'<br>Endereço: '.$end.'<br>Cidade: '.$cidade.'<br>CEP: '.$cep.'<br>Mensagem:</h5>
      <p>'.$mensagem.'</p>
    </div>';


 
 
/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/ 
 

$mail = new PHPMailer();

 
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8_decode()';
$mail->Host  = 'packtell.com.br';
$mail->Port  = '465';
$mail->Username  = $caixaPostalServidorEmail;
$mail->Password  = $caixaPostalServidorSenha;
$mail->From  = $caixaPostalServidorEmail;
$mail->FromName  = utf8_decode($caixaPostalServidorNome);
$mail->IsHTML(true);
$mail->Subject  = utf8_decode('Resultado da avaliação do '.$nomecurso.'.');
$mail->Body  = utf8_decode($mensagem);

 
 
$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
 
if(!$mail->Send()){
$mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
}else{
$mensagemRetorno = 'Mensagem enviada com sucesso!';
} 

}

else{
    header('location:home.html');
}

?>
<script>
window.location.href="confirma.html";
</script>