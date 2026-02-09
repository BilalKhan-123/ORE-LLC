<?php

return [
    'hello' => 'Hallo',
    'thanks' => 'Danke',
    'forgetPasswordEmailSubject' => 'Passwort vergessen',
    'forgetPasswordEmailLine1' => 'Sie haben die Zurücksetzung Ihres Passworts angefordert. Bitte verwenden Sie den folgenden Code, um Ihr Passwort zurückzusetzen.',
    'forgetPasswordEmailLine2' => 'Falls Sie keine Passwortzurücksetzung angefordert haben, sind keine weiteren Schritte erforderlich.',
    'signUpRequestSubject' => 'OTP für die Registrierung erhalten',
    'signUpRequestEmailLine1' => 'Sie haben sich registriert. Bitte verwenden Sie diesen Code, um Ihre Daten für den Registrierungsprozess zu überprüfen.',
    'signUpRequestEmailLine2' => 'Wenn Sie keinen Registrierungscode angefordert haben, ignorieren Sie bitte diese E-Mail.',
    'signInRequestSubject' => 'OTP für die Anmeldung erhalten',
    'signInRequestEmailLine1' => 'Sie haben sich angemeldet. Bitte verwenden Sie diesen Code, um Ihre Daten für den Anmeldevorgang zu überprüfen.',
    'signInRequestEmailLine2' => 'Wenn Sie keinen Anmeldecode angefordert haben, ignorieren Sie bitte diese E-Mail.',
    'verifyUserSubject' => 'Benutzer verifizieren',
    'updateProfileSubject' => 'Profil aktualisieren',
    'signup' => 'Willkommen bei ' . config('app.name') . ' - Ihre Kontodaten',
    'signupEmailLine1' => "Wir freuen uns, Sie bei '" . config('app.name') . "' begrüßen zu dürfen! Ihr Konto wurde von unserem Administrator erfolgreich erstellt, und wir freuen uns, Sie an Bord zu haben.",
    'signupEmailLine2' => 'Unten finden Sie Ihre Kontodetails:',
    'usernameOrEmail' => 'Benutzername/E-Mail:',
    'temporaryPassword' => 'Temporäres Passwort:',
    'clinicCode' => 'Klinikcode:',
    'signupEmailLine3' => 'Um loszulegen, folgen Sie diesen Schritten:',
    'signupEmailLine4' => 'Besuchen Sie die Anmeldeseite von ' . config('app.name') . ':',
    'signupEmailLine5' => 'Geben Sie Ihren Benutzernamen/Ihre E-Mail-Adresse ein.',
    'signupEmailLine6' => 'Melden Sie sich mit dem temporären Passwort an.',
    'dear' => 'Sehr geehrte(r)',
    'hi' => 'Hallo',
    'forgetPasswordLine3' => 'Vielen Dank, dass Sie sich für ' . config('app.name') . ' entschieden haben. Verwenden Sie das folgende OTP, um Ihre Passwortzurücksetzung abzuschließen. Das OTP ist 10 Minuten lang gültig.',
    'verifyUserLine1' => 'Vielen Dank, dass Sie sich für ' . config('app.name') . ' entschieden haben. Verwenden Sie das folgende OTP, um Ihren :subject-Vorgang abzuschließen. Das OTP ist 10 Minuten lang gültig.',
    'participantSignupEmail1' => 'Wir freuen uns, Sie bei ' . config('app.name') . ' begrüßen zu dürfen! Ihre Registrierung ist abgeschlossen, und Sie sind jetzt offiziell ein(e) :role. Seien Sie bereit für eine spannende und bereichernde Erfahrung.',
    'participantSignupEmail2' => 'Wenn Sie Fragen haben oder Hilfe benötigen, ist unser Support-Team gerne für Sie da. Kontaktieren Sie uns unter ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Vielen Dank, dass Sie sich für ' . config('app.name') . ' entschieden haben. Wir freuen uns, Sie an Bord zu haben und können es kaum erwarten, zu sehen, was Sie in unsere Community einbringen werden.',

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Anfrage zum Zurücksetzen des Passworts',
        'line1' => 'Wir hoffen, dass diese Nachricht Sie gut findet. Es scheint, dass Sie das Zurücksetzen des mit Ihnen verknüpften Passworts beantragt haben ' . config('app.name') . ' Konto. Wenn Sie diese Anfrage nicht initiiert haben, ignorieren Sie diese E-Mail bitte.',
        'line2' => 'Um Ihr Passwort zurückzusetzen, klicken Sie bitte auf den folgenden Link:',
        'line3' => 'Wenn der Link nicht anklickbar ist, können Sie die gesamte URL kopieren und in die Adressleiste Ihres Browsers einfügen.',
        'line4' => 'Bitte beachten Sie, dass dieser Link für die nächsten 2 Stunden aktiv bleibt und danach aus Sicherheitsgründen abläuft. Wenn Sie Ihr Passwort nicht innerhalb dieses Zeitraums zurücksetzen, müssen Sie den Vorgang zum Zurücksetzen des Passworts möglicherweise erneut einleiten.',
        'line5' => 'Vielen Dank für Ihre Aufmerksamkeit in dieser Angelegenheit.',
        'clickHere' => 'Klicken Sie hier.',
    ],
    'multiAttempt' => [
        'subject' => ':appName | Glückwunsch! Sie sind jetzt berechtigt, den CCI Test erneut zu versuchen!',
        'line1' => 'Lieber :userName',
        'line2' => 'Sie können jetzt noch einmal den CCI Test absolvieren. Melden Sie sich dazu bitte über den untenstehenden Link an und schon können Sie den CCI Test noch einmal genießen.',
    ],
    'regards' => 'Mit freundlichen Grüßen',
    'appName' => config('app.name'),
];
