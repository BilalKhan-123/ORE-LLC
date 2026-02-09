<?php

return [
    'hello' => 'Witaj',
    'thanks' => 'Dziękuję',
    'forgetPasswordEmailSubject' => 'Przypomnienie hasła',
    'forgetPasswordEmailLine1' => 'Zat prosił(a) o zresetowanie hasła. Użyj poniższego kodu, aby je zresetować.',
    'forgetPasswordEmailLine2' => 'Jeśli nie prosił(a) o zresetowanie hasła, nie musisz podejmować żadnych dalszych czynności.',
    'signUpRequestSubject' => 'Otrzymano kod OTP do rejestracji',
    'signUpRequestEmailLine1' => 'Złożył(a) wniosek o rejestrację. Użyj tego kodu, aby zweryfikować swoje dane w procesie rejestracji.',
    'signUpRequestEmailLine2' => 'Jeśli nie poprosił(a) o kod do rejestracji, zignoruj tę wiadomość.',
    'signInRequestSubject' => 'Otrzymano kod OTP do logowania',
    'signInRequestEmailLine1' => 'Złożył(a) wniosek o logowanie. Użyj tego kodu, aby zweryfikować swoje dane w procesie logowania.',
    'signInRequestEmailLine2' => 'Jeśli nie poprosił(a) o kod do logowania, zignoruj tę wiadomość.',
    'verifyUserSubject' => 'Weryfikacja użytkownika',
    'updateProfileSubject' => 'Aktualizacja profilu',
    'signup' => 'Witaj w ' . config('app.name') . ' - Szczegóły Twojego konta',
    'signupEmailLine1' => 'Witamy w serwisie ' . config('app.name') . '! Twoje konto zostało pomyślnie utworzone przez naszego administratora. Jesteśmy podekscytowani, że Cię tu mamy.',
    'signupEmailLine2' => 'Poniżej znajdują się dane Twojego konta:',
    'usernameOrEmail' => 'Nazwa użytkownika/e-mail:',
    'temporaryPassword' => 'Hasło tymczasowe:',
    'clinicCode' => 'Kod kliniki:',
    'signupEmailLine3' => 'Aby rozpocząć, wykonaj następujące kroki:',
    'signupEmailLine4' => 'Odwiedź stronę logowania ' . config('app.name') . ':',
    'signupEmailLine5' => 'Wprowadź podaną nazwę użytkownika/adres e-mail.',
    'signupEmailLine6' => 'Zaloguj się, używając tymczasowego hasła.',
    'dear' => 'Szanowny/a',
    'hi' => 'Cześć',

    'forgetPasswordLine3' => 'Dziękujemy za wybranie ' . config('app.name') . '. Użyj poniższego kodu OTP, aby zakończyć procedurę resetowania hasła. Kod OTP jest ważny przez 10 minut.',
    'verifyUserLine1' => 'Dziękujemy za wybranie ' . config('app.name') . '. Użyj poniższego kodu OTP, aby zakończyć proces :subject. Kod OTP jest ważny przez 10 minut.',
    'participantSignupEmail1' => 'Witamy w ' . config('app.name') . '! Twoja rejestracja została zakończona i teraz oficjalnie jesteś :role. Przygotuj się na wspaniałe i wzbogacające doświadczenie.',
    'participantSignupEmail2' => 'Jeśli masz pytania lub potrzebujesz pomocy, nasz zespół wsparcia jest do Twojej dyspozycji. Skontaktuj się z nami pod adresem ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Dziękujemy za wybranie ' . config('app.name') . '. Jesteśmy podekscytowani, że jesteś z nami i nie możemy się doczekać, co wniesiesz do naszej społeczności.',

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Żądanie resetowania hasła',
        'line1' => 'Mamy nadzieję, że ta wiadomość zastanie Cię w dobrym zdrowiu. Wygląda na to, że poprosiłeś o zresetowanie powiązanego z Tobą hasła ' . config('app.name') . ' konto. Jeśli to nie Ty zainicjowałeś tę prośbę, zignoruj tę wiadomość e-mail.',
        'line2' => 'Aby zresetować hasło, kliknij poniższy link:',
        'line3' => 'Jeżeli linku nie można kliknąć, możesz skopiować cały adres URL i wkleić go w pasku adresu przeglądarki.',
        'line4' => 'Należy pamiętać, że ten link pozostanie aktywny przez następne 2 godziny, po czym wygaśnie ze względów bezpieczeństwa. Jeśli nie zresetujesz hasła w tym czasie, konieczne może być ponowne zainicjowanie procesu resetowania hasła.',
        'line5' => 'Dziękuję za zwrócenie uwagi na tę kwestię.',
        'clickHere' => 'Kliknij tutaj.',
    ],

    /**
     * Multiple attempt
     */
    'multiAttempt' => [
        'subject' => ':appName | Gratulacje! Możesz teraz ponownie przystąpić do egzaminu CCI!',
        'line1' => 'Drogi :userName',
        'line2' => 'Możesz teraz przystąpić jeszcze raz do egzaminu CCI. Aby to zrobić, zaloguj się, klikając w link podany poniżej, a będziesz mógł ponownie przystąpić do testu CCI.',
    ],
    'regards' => 'Pozdrawiam,',
    'appName' => config('app.name'),
];
