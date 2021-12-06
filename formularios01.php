<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Simples: Form</title>
</head>
<body>
    <form action="formsimplestratamento.php" method=POST>
        Nome:
        <input type="text" name=nome><br>

        Sobrenome:
        <input type="text" name=sobrenome><br>

        Estado Civil:
        <select name="estadocivil" id="">
            <option value="">Solteiro</option>
            <option value="">Casado</option>
            <option value="">Divorciado</option>
            <option value="">Viúvo</option>
        </select>

        <input type="reset" value="Limpar">
        <input type="submit" value="Enviar">

    </form>
</body>
</html>