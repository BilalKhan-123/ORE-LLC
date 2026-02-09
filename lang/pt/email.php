<?php

return [
    'hello' => 'Olá',
    'thanks' => 'Obrigado(a)',
    'forgetPasswordEmailSubject' => 'Esqueci a Senha',
    'forgetPasswordEmailLine1' => 'Você solicitou a redefinição de sua senha. Use o código abaixo para redefini-la.',
    'forgetPasswordEmailLine2' => 'Se você não solicitou a redefinição de senha, não é necessário realizar nenhuma outra ação.',
    'signUpRequestSubject' => 'Código OTP Recebido para Cadastro',
    'signUpRequestEmailLine1' => 'Você solicitou um código para se cadastrar. Use este código para verificar seus dados no processo de cadastro.',
    'signUpRequestEmailLine2' => 'Se você não solicitou o código de cadastro, ignore este e-mail.',
    'signInRequestSubject' => 'Código OTP Recebido para Login',
    'signInRequestEmailLine1' => 'Você solicitou um código para fazer login. Use este código para verificar seus dados no processo de login.',
    'signInRequestEmailLine2' => 'Se você não solicitou o código de login, ignore este e-mail.',
    'verifyUserSubject' => 'Verificar Usuário',
    'updateProfileSubject' => 'Atualizar Perfil',
    'signup' => 'Bem-vindo ao(à) ' . config('app.name') . ' - Detalhes da sua Conta',
    'signupEmailLine1' => 'Estamos contentes em recebê-lo(a) no(a) ' . config('app.name') . '! Sua conta foi criada com sucesso por nosso administrador. É um prazer tê-lo(a) a bordo.',
    'signupEmailLine2' => 'Abaixo estão os detalhes da sua conta:',
    'usernameOrEmail' => 'Nome de Usuário/Email:',
    'temporaryPassword' => 'Senha Temporária:',
    'clinicCode' => 'Código da Clínica:',
    'signupEmailLine3' => 'Para começar, siga estas etapas:',
    'signupEmailLine4' => 'Visite a página de login do(a) ' . config('app.name') . ':',
    'signupEmailLine5' => 'Insira o nome de usuário/e-mail fornecido.',
    'signupEmailLine6' => 'Use a senha temporária para fazer login.',
    'dear' => 'Caro(a)',
    'hi' => 'Olá',

    'forgetPasswordLine3' => 'Obrigado(a) por escolher o(a) ' . config('app.name') . '. Use o seguinte OTP para concluir o procedimento de Redefinição de Senha. O OTP é válido por 10 minutos.',
    'verifyUserLine1' => 'Obrigado(a) por escolher o(a) ' . config('app.name') . '. Use o seguinte OTP para concluir o processo de :subject. O OTP é válido por 10 minutos.',
    'participantSignupEmail1' => 'Estamos contentes em recebê-lo(a) no(a) ' . config('app.name') . '! Seu registro está completo e agora você é oficialmente um(a) :role. Prepare-se para uma experiência envolvente e enriquecedora.',
    'participantSignupEmail2' => 'Se você tiver alguma dúvida ou precisar de ajuda, nossa equipe de suporte está aqui para ajudar. Entre em contato conosco em ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Obrigado(a) por escolher o(a) ' . config('app.name') . '. Estamos contentes em tê-lo(a) a bordo e mal podemos esperar para ver o que você trará para a nossa comunidade.',

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Solicitação de redefinição de senha',
        'line1' => 'Esperamos que esta mensagem o encontre bem. Parece que você solicitou a redefinição da senha associada a você ' . config('app.name') . ' conta. Se você não iniciou esta solicitação, ignore este e-mail.',
        'line2' => 'Para redefinir sua senha, clique no link a seguir:',
        'line3' => 'Se o link não for clicável, você pode copiar e colar o URL inteiro na barra de endereço do seu navegador.',
        'line4' => 'Esteja ciente de que este link permanecerá ativo pelas próximas 2 horas, após as quais expirará por motivos de segurança. Se você não redefinir sua senha dentro desse prazo, poderá ser necessário iniciar o processo de redefinição de senha novamente.',
        'line5' => 'Obrigado pela sua atenção a este assunto.',
        'clickHere' => 'Clique aqui',
    ],
    /**
     * Multiple attempt
     */
    'multiAttempt' => [
        'subject' => ':appName | Parabéns! Agora você está qualificado para tentar o teste CCI novamente!',
        'line1' => 'Caro :userName',
        'line2' => 'Agora você pode fazer mais um teste CCI. Para fazer isso, faça login clicando no link fornecido abaixo e você poderá aproveitar o teste CCI mais uma vez.',
    ],
    'regards' => 'Atenciosamente,',
    'appName' => config('app.name'),
];
