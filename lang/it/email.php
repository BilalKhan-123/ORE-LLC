<?php

return [
    'hello' => 'Ciao',
    'thanks' => 'Grazie',
    'forgetPasswordEmailSubject' => 'Hai dimenticato la password?',
    'forgetPasswordEmailLine1' => 'Hai richiesto il ripristino della password. Per favore, usa il codice seguente per ripristinare la tua password.',
    'forgetPasswordEmailLine2' => 'Se non hai richiesto il ripristino della password, non sono necessari ulteriori passaggi.',
    'signUpRequestSubject' => 'Ricevuto codice OTP per l\'iscrizione',
    'signUpRequestEmailLine1' => 'Ti sei registrato. Per favore, usa questo codice per verificare i tuoi dati per il processo di registrazione.',
    'signUpRequestEmailLine2' => 'Se non hai richiesto un codice di registrazione, ignora questa e-mail.',
    'signInRequestSubject' => 'Ricevuto codice OTP per l\'accesso',
    'signInRequestEmailLine1' => 'Ti sei autenticato. Per favore, usa questo codice per verificare i tuoi dati per il processo di accesso.',
    'signInRequestEmailLine2' => 'Se non hai richiesto un codice di accesso, ignora questa e-mail.',
    'verifyUserSubject' => 'Verifica utente',
    'updateProfileSubject' => 'Aggiorna profilo',
    'signup' => 'Benvenuto in ' . config('app.name') . ' - I tuoi dati di accesso',
    'signupEmailLine1' => "Siamo lieti di darti il ​​benvenuto in '" . config('app.name') . "'! Il tuo account è stato creato con successo dal nostro amministratore e siamo lieti di averti a bordo.",
    'signupEmailLine2' => 'Di seguito troverai i dettagli del tuo account:',
    'usernameOrEmail' => 'Nome utente/E-mail:',
    'temporaryPassword' => 'Password temporanea:',
    'clinicCode' => 'Codice clinica:',
    'signupEmailLine3' => 'Per iniziare, segui questi passaggi:',
    'signupEmailLine4' => 'Visita la pagina di accesso di ' . config('app.name') . ':',
    'signupEmailLine5' => 'Inserisci il tuo nome utente/indirizzo e-mail.',
    'signupEmailLine6' => 'Accedi con la password temporanea.',
    'dear' => 'Gentile',
    'hi' => 'Ciao',
    'forgetPasswordLine3' => 'Grazie per aver scelto ' . config('app.name') . '. Usa il seguente OTP per completare il ripristino della password. L\'OTP è valido per 10 minuti.',
    'verifyUserLine1' => 'Grazie per aver scelto ' . config('app.name') . '. Usa il seguente OTP per completare la tua operazione :subject. L\'OTP è valido per 10 minuti.',
    'participantSignupEmail1' => 'Siamo lieti di darti il ​​benvenuto in ' . config('app.name') . '! La tua registrazione è completata e ora sei ufficialmente un(a) :role. Preparati per un\'esperienza emozionante e arricchente.',
    'participantSignupEmail2' => 'Se hai domande o hai bisogno di aiuto, il nostro team di supporto è a tua disposizione. Contattaci all\'indirizzo ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Grazie per aver scelto ' . config('app.name') . '. Siamo lieti di averti a bordo e non vediamo l\'ora di vedere cosa apporterai alla nostra community.',

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Richiesta di reimpostazione della password',
        'line1' => 'Ci auguriamo che questa e-mail ti trovi bene. Sembra che tu abbia richiesto il ripristino della password associata al tuo account ' . config('app.name') . '. Se non hai avviato questa richiesta, ignora cortesemente questa e-mail.',
        'line2' => 'Per reimpostare la tua password, fai clic sul seguente link:',
        'line3' => 'Se il link non è cliccabile, puoi copiare l\'intera URL e incollarla nella barra degli indirizzi del tuo browser.',
        'line4' => 'Tieni presente che questo link è valido per le prossime 2 ore e scadrà per motivi di sicurezza. Se non reimposti la password entro questo periodo, potresti dover riavviare la procedura di reimpostazione della password.',
        'line5' => 'Grazie per la tua attenzione in merito.',
        'clickHere' => 'Clicca qui.',
    ],

    /**
     * Multiple attempt
     */
    'multiAttempt' => [
        'subject' => ':appName | Congratulazioni! Ora puoi tentare di nuovo il test CCI!',
        'line1' => 'Caro :userName',
        'line2' => "Ora puoi sostenere ancora una volta il test CCI. Per fare ciò, effettua l'accesso facendo clic sul collegamento fornito di seguito e potrai goderti nuovamente il test CCI.",
    ],
    'regards' => 'Cordiali saluti',
    'appName' => config('app.name'),
];
