<footer id="footer" class="footer light-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
            <a href="#about" class="logo d-flex align-items-center">
                <span class="sitename">{{ config('site.siteTitle') }}</span>
            </a>
            <div class="footer-contact pt-3">
                <p>A108 Adam Street</p>
                <p>New York, NY 535022</p>
                <p class="mt-3"><strong>Phone:</strong> <span>+92 300 743 6946</span></p>
                <p><strong>Email:</strong> <span>info@example.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Terms of service</a></li>
                <li><a href="#">Privacy policy</a></li>
            </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
                <li><a href="#">Service 1</a></li>
                <li><a href="#">Service 2</a></li>
                <li><a href="#">Service 3</a></li>
                <li><a href="#">Service 4</a></li>
                <li><a href="#">Service 5</a></li>
            </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Departments</h4>
            <ul>
                <li><a href="#">Department 1</a></li>
                <li><a href="#">Department 2</a></li>
                <li><a href="#">Department 3</a></li>
                <li><a href="#">Department 4</a></li>
                <li><a href="#">Department 5</a></li>
            </ul>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright {{ date('Y') }}</span> <strong class="px-1 sitename">{{ config('site.siteTitle') }}</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://www.linkedin.com/in/bilal-khan-bk1992/">Bilal</a> | <a href="https://www.linkedin.com/in/bilal-khan-bk1992/">Khan</a>
        </div>
    </div>

</footer>