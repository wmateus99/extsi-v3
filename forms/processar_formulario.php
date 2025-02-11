<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar as respostas do formulário
    $respostas = [];
    for ($i = 1; $i <= 11; $i++) {
        $respostas[$i] = $_POST["resposta$i"];
    }

    // Gerar o HTML para o PDF
    $html_content = '<h1>Atividade: Componentes de um Computador</h1>';
    foreach ($respostas as $key => $value) {
        $html_content .= "<p><strong>Questão $key:</strong><br/>$value</p>";
    }

    // Incluir a biblioteca HTML2PDF
    require_once('html2pdf/vendor/autoload.php');
    try {
        // Criação do objeto HTML2PDF
        $html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'pt');
        $html2pdf->writeHTML($html_content);
        $pdf_file = '/tmp/atividade.pdf';
        $html2pdf->output($pdf_file, 'F'); // Salvar o PDF no servidor
    } catch (Html2PdfException $e) {
        echo $e;
        exit;
    }

    // Enviar o PDF por e-mail
    $to = 'email@exemplo.com'; // Substitua com o e-mail desejado
    $subject = 'Prova Enviada';
    $message = 'O aluno enviou a prova em formato PDF.';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: multipart/mixed; boundary="boundary"' . "\r\n";
    $headers .= 'From: no-reply@seusite.com' . "\r\n";

    // Corpos do e-mail e anexos
    $body = '--boundary' . "\r\n";
    $body .= 'Content-Type: text/plain; charset=UTF-8' . "\r\n\r\n";
    $body .= $message . "\r\n";
    $body .= '--boundary' . "\r\n";
    $body .= 'Content-Type: application/pdf; name="atividade.pdf"' . "\r\n";
    $body .= 'Content-Disposition: attachment; filename="atividade.pdf"' . "\r\n";
    $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
    $body .= chunk_split(base64_encode(file_get_contents($pdf_file))) . "\r\n";
    $body .= '--boundary--';

    // Enviar e-mail
    if (mail($to, $subject, $body, $headers)) {
        echo 'Prova enviada com sucesso!';
    } else {
        echo 'Falha ao enviar a prova.';
    }
}
?>
