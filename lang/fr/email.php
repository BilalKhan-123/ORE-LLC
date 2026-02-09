<?php

return [
    'hello' => 'Bonjour',
    'thanks' => 'Merci',
    'forgetPasswordEmailSubject' => 'Mot de passe oublié',
    'forgetPasswordEmailLine1' => 'Vous avez demandé à réinitialiser votre mot de passe, veuillez utiliser le code ci-dessous pour le réinitialiser.',
    'forgetPasswordEmailLine2' => 'Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune action supplémentaire n\'est nécessaire.',
    'signUpRequestSubject' => 'OTP reçu pour l\'inscription',
    'signUpRequestEmailLine1' => 'Vous avez demandé une inscription, veuillez utiliser ce code pour vérifier vos détails pour le processus d\'inscription.',
    'signUpRequestEmailLine2' => 'Si vous n\'avez pas demandé de code d\'inscription, veuillez ignorer ce courriel.',
    'signInRequestSubject' => 'OTP reçu pour la connexion',
    'signInRequestEmailLine1' => 'Vous avez demandé une connexion, veuillez utiliser ce code pour vérifier vos détails pour le processus de connexion.',
    'signInRequestEmailLine2' => 'Si vous n\'avez pas demandé de code de connexion, veuillez ignorer ce courriel.',
    'verifyUserSubject' => 'Vérifier l\'utilisateur',
    'updateProfileSubject' => 'Mise à jour du profil',
    'signup' => 'Bienvenue sur ' . config('app.name') . ' - Détails de votre compte',
    'signupEmailLine1' => "Nous sommes ravis de vous accueillir sur '" . config('app.name') . '! Votre compte a été créé avec succès par notre administrateur, et nous sommes ravis de vous avoir à bord.',
    'signupEmailLine2' => 'Voici les détails de votre compte:',
    'usernameOrEmail' => 'Nom d\'utilisateur/Email:',
    'temporaryPassword' => 'Mot de passe temporaire:',
    'clinicCode' => 'Code de la clinique:',
    'signupEmailLine3' => 'Pour commencer, suivez ces étapes:',
    'signupEmailLine4' => 'Visitez la page de connexion de ' . config('app.name') . ':',
    'signupEmailLine5' => 'Entrez votre nom d\'utilisateur/email fourni.',
    'signupEmailLine6' => 'Utilisez le mot de passe temporaire pour vous connecter.',
    'dear' => 'Cher',
    'hi' => 'Salut',
    'forgetPasswordLine3' => 'Merci d\'avoir choisi ' . config('app.name') . '. Utilisez le code OTP suivant pour finaliser vos procédures de réinitialisation du mot de passe. Le code OTP est valide pendant 10 minutes.',
    'verifyUserLine1' => 'Merci d\'avoir choisi ' . config('app.name') . '. Utilisez le code OTP suivant pour finaliser votre processus :subject. Le code OTP est valide pendant 10 minutes.',
    'participantSignupEmail1' => 'Nous sommes ravis de vous accueillir sur ' . config('app.name') . '! Votre inscription est complète, et vous êtes maintenant officiellement un(e) :role. Préparez-vous à une expérience engageante et enrichissante.',
    'participantSignupEmail2' => 'Si vous avez des questions ou avez besoin d\'assistance, notre équipe de support est là pour vous aider. Contactez-nous à ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Merci d\'avoir choisi ' . config('app.name') . '. Nous sommes ravis de vous avoir à bord et avons hâte de voir ce que vous apporterez à notre communauté.',

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Demande de réinitialisation du mot de passe',
        'line1' => 'Nous espérons que ce message vous trouve bien. Il semble que vous ayez demandé à réinitialiser le mot de passe associé à votre compte ' . config('app.name') . '. Si vous n\'avez pas initié cette demande, veuillez ignorer cet e-mail.',
        'line2' => 'Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant :',
        'line3' => "Si le lien n'est pas cliquable, vous pouvez copier et coller l'URL entière dans la barre d'adresse de votre navigateur.",
        'line4' => 'Veuillez noter que ce lien restera actif pendant les 2 prochaines heures, après quoi il expirera pour des raisons de sécurité. Si vous ne réinitialisez pas votre mot de passe dans ce délai, vous devrez peut-être relancer le processus de réinitialisation du mot de passe.',
        'line5' => 'Merci de votre attention à cette affaire.',
        'clickHere' => 'Cliquez ici.',
    ],

    /**
     * Multiple attempt
     */
    'multiAttempt' => [
        'subject' => ':appName | Toutes nos félicitations! Vous êtes désormais éligible pour tenter à nouveau le test CCI !',
        'line1' => 'Cher :userName',
        'line2' => 'Vous pouvez maintenant passer le test CCI une fois de plus. Pour ce faire, veuillez vous connecter en cliquant sur le lien fourni ci-dessous et vous pourrez à nouveau profiter du test CCI.',
    ],
    'regards' => 'Cordialement',
    'appName' => config('app.name'),
];
