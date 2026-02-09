<?php

return [
    'hello' => 'Hello',
    'thanks' => 'Thanks',
    'forgetPasswordEmailSubject' => 'Forgot Password',
    'forgetPasswordEmailLine1' => 'You requested to reset your password, please use the below code to reset your password.',
    'forgetPasswordEmailLine2' => 'If you did not request a password reset, no further action is required.',
    'signUpRequestSubject' => 'OTP Receieved for Sign-up',
    'signUpRequestEmailLine1' => 'You requested to sign-up request, please use this code to verify your detail for sign-up process.',
    'signUpRequestEmailLine2' => 'If you have not requested to sign-up code, please ignore this mail.',
    'signInRequestSubject' => 'OTP Receieved for Sign-in',
    'signInRequestEmailLine1' => 'You requested to sign-in request, please use this code to verify your detail for sign-in process.',
    'signInRequestEmailLine2' => 'If you have not requested to sign-in code, please ignore this mail.',
    'verifyUserSubject' => 'Verify User',
    'updateProfileSubject' => 'Update Profile',
    'signup' => 'Welcome to ' . config('app.name') . ' - Your Account Details',
    'signupEmailLine1' => "We're excited to welcome you to '" . config('app.name') . "! Your account has been successfully created by our admin, and we're thrilled to have you on board.",
    'signupEmailLine2' => 'Below are your account details:',
    'usernameOrEmail' => 'Username/Email:',
    'temporaryPassword' => 'Temporary Password:',
    'clinicCode' => 'Clinic Code:',
    'signupEmailLine3' => 'To get started, follow these steps:',
    'signupEmailLine4' => 'To visit the :roleName portal, click <a href=":regUrl" targe="_blank">here.</a>',
    'signupEmailLine5' => 'Enter your provided username/email.',
    'signupEmailLine6' => 'Use the temporary password to log in.',
    'dear' => 'Dear',
    'hi' => 'Hi',
    'forgetPasswordLine3' => 'Thank you for choosing ' . config('app.name') . '. Use the following OTP to complete your Reset Password procedures. OTP is valid for 10 minutes.',
    'verifyUserLine1' => 'Thank you for choosing' . config('app.name') . '. Use the following OTP to complete your :subject process. OTP is valid for 10 minutes.',
    'participantSignupEmail1' => "We're excited to welcome you to " . config('app.name') . "! Your registration is complete, and you're now officially a :role. Get ready for an engaging and enriching experience.",
    'participantSignupEmail2' => 'If you have any questions or need assistance, our support team is here to help. Reach out to us at ' . config('site.support.email') . '.',
    'participantSignupEmail3' => 'Thank you for choosing ' . config('app.name') . ". We're excited to have you on board and can't wait to see what you'll bring to our community.",

    /**
     * Forgot password
     */
    'forgetPassword' => [
        'subject' => 'Password Reset Request',
        'line1' => 'We hope this message finds you well. It appears that you have requested to reset the password associated with you ' . config('app.name') . ' account. If you did not initiate this request, please ignore this email.',
        'line2' => 'To reset your password, please click on the following link:',
        'line3' => "If the link is not clickable, you can copy and paste the entire URL into your browser's address bar.",
        'line4' => 'Please be aware that this link will remain active for the next 2 hours, after which it will expire for security reasons. If you do not reset your password within this timeframe, you may need to initiate the password reset process again.',
        'line5' => 'Thank you for your attention to this matter.',
        'clickHere' => 'Click Here.',
    ],

    /**
     * Multiple attempt
     */
    'multiAttempt' => [
        'subject' => ':appName | Congratulations! You are now eligible to attempt the CCI test again!',
        'line1' => 'Dear :userName',
        'line2' => 'You can now take the one more time CCI test. To do so, please log in by clicking on the link provided below, and you can enjoy the CCI test once again.',
    ],
    'regards' => 'Regards',
    'appName' => config('app.name'),

    //New Keys
    'cciPaymentPaid' => [
        'subject' => 'Congratulations on your Purchase of the CCI Questionnaire',
        'line1' => 'Thank you for completing the CCI questionnaire. You now have valuable information about how your profile compares with the way centenarians perceive and emote their world: what we call Centenarian Consciousness. Most importantly, based on our suggestions, you can begin to make changes to learn longevity wellness at any age.',
        'line2' => 'We are building a VIP page on our website for all CCI participants to have access to our latest resources on how to continue to learn Centenarian Consciousness through my videos, articles, blogs, and interviews. As soon as the VIP page is ready, we will notify you and provide you with a link and password. Meanwhile, you can visit my YouTube channel where you can enjoy over 380 videos on useful biocognitive topics and applications: https://www.youtube.com/c/DrmarioMartinez',
        'line3' => "<strong>Note:</strong> After completing the payment, you need to take the CCI Questionnaire. If you leave the page, you won't be able to take the CCI Questionnaire.",
        'line4' => 'Please contact us if you have any other questions at:',
        'line5' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
        'toWelness' => 'To your wellness,',
        'collegeName' => 'Biocognitive Science Institute',
    ],
    'glycanagePaymentPaid' => [
        'subject' => 'Congratulations on your Purchase of the GlycanAge Kit and the CCI.',
        'line1' => 'We ordered your GlycanAge kit, and you will receive it within a week, with all the instructions 
        and how to return it . After mailing the kit back, GlycanAge will email you with the results of 
        your  biological  age  within  3  to  4  weeks.  The  reason  for  the  longer  turnaround  time,  is  that 
        several measures are taken to increase the reliability of the results.',
        'line2' => 'You will  also have access to our private Longevity VIP page, at no extra cost, on our website  
        with videos, articles, and blogs on how to improve on all 8 factors of the CCI as well as the 
        latest  news  on  GlycanAge  and  the  CCI.  We  are  conducting  research  to  find  correlations 
        between biological age and the 8 CCI factors. The findings will be available to you as soon as 
        they are published.',
        'line3' => "<strong>Note:</strong> After completing the payment, you need to take the CCI Questionnaire. If you leave the page, you won't be able to take the CCI Questionnaire.",
        'line4' => 'Please contact us for the Longevity VIP page password and for any other questions.',
        'line5' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
        'toWelness' => 'To your wellness,',
        'collegeName' => 'Biocognitive Science Institute',
    ],
    'testCompleted' => [
        'subject' => 'Congratulations on completing the CCI questionnaire.',
        'line1' => 'Thank you for completing the CCI questionnaire. You now have valuable information about how your profile compares with the way centenarians perceive and emote their world: what we call Centenarian Consciousness. Most importantly, based on our recommendations, you can begin to make changes and learn longevity wellness at any age.',
        'line2' => 'CCI participants can also have access to our latest resources on how to continue to learn Centenarian Consciousness through my videos, articles, blogs, and interviews. You can visit my YouTube channel where you can enjoy over 420 videos on useful biocognitive topics and applications: https://www.youtube.com/c/DrmarioMartinez',
        'line3' => 'Please contact us if you have any other questions at:',
        'line4' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
        'toWelness' => 'To your wellness,',
        'collegeName' => 'Biocognitive Science Institute',
    ],
    'testPurchased' => [
        'subject' => 'Congratulations on your Purchase of the :productName Questionnaire',
        'line1' => 'Your payment for <strong>:productName</strong> :quantity has been successfully received. From now on, your participant will be able to take the test. Please follow the participant instructions below:',
        'point1' => 'Please share your client code <strong>:clientCode</strong> with your participants. You can find your client code in your dashboard.',
        'point2' => 'Tell the participant to visit the <a href=":registrationUrl" target="_blank">Longevity registration page.</a>',
        'point3' => 'Make sure that during the sign-up process, participants enter the provided client code.',
        'point4' => 'Visit the <a href=":testUrl" target="_blank">CCI questionnaire page</a> to submit your test.',
        'line2' => 'Please contact us if you have any other questions at:',
        'line3' => 'Our certified CCI consultant will contact you to schedule the online consultation(s)',
        'line4' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
        'toWelness' => 'To your wellness,',
        'collegeName' => 'Biocognitive Science Institute',
    ],

    'participantTestPurchased' => [
        'subject' => 'Congratulations on your Purchase of the :productName Questionnaire',
        'line1' => 'Your payment for <strong>:productName</strong> :quantity has been successfully received. You are now eligible to take the test. Please follow the instructions below:',
        'point1' => 'Visit the <a href=":testUrl" target="_blank">test page</a> to begin your questionnaire.',
        'line2' => 'If you have any questions, please contact us at:',
        'line3' => 'Our certified CCI consultant will contact you to schedule the online consultation(s)',
        'line4' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
        'toWelness' => 'To your wellness,',
        'collegeName' => 'Biocognitive Science Institute',
    ],

    'userCouponAlert' => [
        'subject' => 'Your Exclusive Coupon Inside! 🎉',
        'line1' => "We're pleased to offer you an exclusive coupon for your next purchase:",
        'line2' => '<strong>Coupon Code:</strong> :couponCode',
        'line3' => '<strong>Discount:</strong> :discount',
        'line4' => '<strong>Valid Until:</strong> :validUntil',
        'line5' => 'To redeem, simply <a href=":paymentUrl">visit this page</a>, select the product, and apply the coupon code at payment page.',
        'line6' => 'Please contact us if you have any other questions at:',
        'line7' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
        'toWelness' => 'To your wellness,',
        'collegeName' => 'Biocognitive Science Institute',
    ],

    'commonText' => [
        'beWell' => 'Be well,',
        'teamName' => 'The Longemetrics Team',
    ],

    'cciTestCompleted' => [
        'subject' => 'Congratulations on completing the CCI questionnaire.',
        'line1' => 'Thank you for completing the CCI questionnaire. You have valuable information about how your profile compares with centenarians perceive and emote their world: what we call Centenarian Consciousness Most importantly, based on our recommendations, you can begin to changes to learn longevity wellness at any age.',
        'line2' => "In addition to the suggestions on the CCI results, we encourage you to visit Dr.Mario Martinez's YouTube channel where you can enjoy over 400 videos on healthy longevity and other related subjects to enhance your wellness journey. Go to: https://www.youtube.com/c/DrMarioMartinez",
        'line3' => 'Please contact us if you have any other questions at:',
        'line4' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
    ],
    'cciPlusTestCompleted' => [
        'subject' => 'Congratulations on completing the CCI questionnaire.',
        'line1' => 'Thank you for completing the CCI questionnaire. You now have valuable information about how your profile compares with the way centenarians perceive and emote their world: what we call Centenarian Consciousness. Most importantly, based on our recommendations, you can begin to make changes to learn longevity wellness at any age.',
        'line2' => 'The option that you chose includes one (50 minute) individual session online (Zoom) with one of our CCI certified consultants to provide advanced interpretation of your results, and assist you in developing a plan to implement changes on your path toward healthy longevity. Please note that after completing the CCI, we will contact you to arrange a date and time for your consultation.',
        'line3' => "In addition to the suggestions on the CCI results, we encourage you to visit Dr.Mario Martinez's YouTube channel where you can enjoy over 400 videos on healthy longevity and other related subjects to enhance your wellness journey. Go to: https://www.youtube.com/c/DrMarioMartinez",
        'line4' => 'Please contact us if you have any other questions at:',
        'line5' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
    ],
    'cciConsultationTestCompleted' => [
        'subject' => 'Congratulations on completing the CCI questionnaire.',
        'line1' => 'The option that you purchased allowed you to choose up to 10 (50 minute) individual sessions online (Zoom) with one of our CCI certified consultants to provide advanced interpretation of your results, and assist you in developing a plan to implement changes on your path toward healthy longevity. Please note that you will be contacted after you complete the CCI to schedule dates and times for your consultations.',
        'line2' => "In addition to the suggestions on the CCI results and the private consultations, we also encourage you to visit Dr. Mario Martinez's YouTube channel where you can enjoy over 400 videos on healthy longevity and other related subjects to enhance your wellness journey. Go to: https://www.youtube.com/c/DrMarioMartinez",
        'line3' => 'Please contact us if you have any other questions at:',
        'line4' => '<a href="mailto:bsi@biocognitive.com">bsi@biocognitive.com</a>',
    ],

];
