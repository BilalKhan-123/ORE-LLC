<?php

return [
    'hello' => 'Hola',
    'thanks' => 'Gracias',
    'forgetPasswordEmailSubject' => 'Olvidaste tu contraseña',
    'forgetPasswordEmailLine1' => 'Solicitaste restablecer tu contraseña, utiliza el siguiente código para hacerlo.',
    'forgetPasswordEmailLine2' => 'Si no solicitaste el restablecimiento de tu contraseña, puedes ignorar este correo.',
    'signUpRequestSubject' => 'Recibiste un código OTP para registrarte',
    'signUpRequestEmailLine1' => 'Solicitaste registrarte, utiliza este código para verificar tus datos y completar el proceso.',
    'signUpRequestEmailLine2' => 'Si no solicitaste el código de registro, puedes ignorar este correo.',
    'signInRequestSubject' => 'Recibiste un código OTP para iniciar sesión',
    'signInRequestEmailLine1' => 'Solicitaste iniciar sesión, utiliza este código para verificar tus datos y acceder a tu cuenta.',
    'signInRequestEmailLine2' => 'Si no solicitaste el código de inicio de sesión, puedes ignorar este correo.',
    'verifyUserSubject' => 'Verificar usuario',
    'updateProfileSubject' => 'Actualizar perfil',
    'signup' => 'Bienvenido(a) a ' . config('app.name') . ' - Detalles de tu cuenta',
    'signupEmailLine1' => "¡Nos entusiasma darte la bienvenida a '" . config('app.name') . "'! Tu cuenta ha sido creada con éxito por nuestro administrador, y estamos encantados de tenerte a bordo.",
    'signupEmailLine2' => 'A continuación encontrarás los detalles de tu cuenta:',
    'usernameOrEmail' => 'Usuario/Correo electrónico:',
    'temporaryPassword' => 'Contraseña temporal:',
    'clinicCode' => 'Código de la clínica:',
    'signupEmailLine3' => 'Para comenzar, sigue estos pasos:',
    'signupEmailLine4' => 'Visita la página de inicio de sesión de ' . config('app.name') . ':',
    'signupEmailLine5' => 'Introduce el nombre de usuario/correo electrónico proporcionado.',
    'signupEmailLine6' => 'Utiliza la contraseña temporal para iniciar sesión.',
    'dear' => 'Estimado(a)',
    'hi' => 'Hola',
    'forgetPasswordLine3' => 'Gracias por elegir ' . config('app.name') . '. Utiliza el siguiente código OTP para completar el proceso de restablecimiento de tu contraseña. El código OTP es válido durante 10 minutos.',
    'verifyUserLine1' => 'Gracias por elegir ' . config('app.name') . '. Utiliza el siguiente código OTP para completar tu proceso de :subject. El código OTP es válido durante 10 minutos.',
    'participantSignupEmail1' => '¡Nos entusiasma darte la bienvenida a ' . config('app.name') . "'! Tu registro se ha completado y ahora eres oficialmente un(a) :role. Prepárate para una experiencia atractiva y enriquecedora.",
    'participantSignupEmail2' => 'Si tienes alguna pregunta o necesitas ayuda, nuestro equipo de soporte está aquí para ayudarte. Ponte en contacto con nosotros a través de ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Gracias por elegir ' . config('app.name') . '. Estamos encantados de tenerte a bordo y no podemos esperar a ver lo que aportarás a nuestra comunidad.',

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Solicitud de restablecimiento de contraseña',
        'line1' => 'Esperamos que este mensaje te encuentre bien. Parece que has solicitado restablecer la contraseña asociada a tu cuenta de ' . config('app.name') . '. Si no iniciaste esta solicitud, ignora este correo.',
        'line2' => 'Para restablecer tu contraseña, haz clic en el siguiente enlace:',
        'line3' => 'Si el enlace no se puede hacer clic, puedes copiar y pegar toda la URL en la barra de direcciones de tu navegador.',
        'line4' => 'Ten en cuenta que este enlace permanecerá activo durante las próximas 2 horas, después de las cuales caducará por razones de seguridad. Si no restableces tu contraseña dentro de este plazo, es posible que tengas que iniciar el proceso de restablecimiento de contraseña nuevamente.',
        'line5' => 'Gracias por tu atención a este asunto.',
        'clickHere' => 'Haz clic aquí.',
    ],

    /**
     * Multiple attempt
     */
    'multiAttempt' => [
        'subject' => ':appName | Felicidades! ¡Ahora eres elegible para intentar nuevamente la prueba CCI!',
        'line1' => 'Estimada :userName',
        'line2' => 'Ahora puede realizar la prueba CCI una vez más. Para hacerlo, inicie sesión haciendo clic en el enlace que se proporciona a continuación y podrá disfrutar de la prueba CCI una vez más.',
    ],
    'regards' => 'Saludos',
    'appName' => config('app.name'),
];
