<footer class="page-footer">
    <div class="container">
        <div class="row pt-2">
            <div class="left-side col-md-4 col-xl-4 footer-text">
                <h5 class="font-weight-bold footer-text-title">Keiennieuws</h5>
                <div class="pr-xl-4"><a class="brand" href="index.html"></a>
                    <p class="">We doen ons best om de website goed te laten werken.<br><br>
                        Mocht er onverhoopt iets niet
                        duidelijk zijn, mail dan naar <a href="mailto: keiennieuws@hotmail.com">keiennieuws@hotmail.com</a>
                        <br><br>
                        Met dank aan Ruben van Rijen voor het maken van de website.
                    </p>
                    <!-- Rights-->
                </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="right-side col-md-4 col-xl-4">
                <ul class="footer-links nav flex-column text-left">
                    <h5 class="text-white font-weight-bold">Links</h5>
                    <li class="nav-item"><a class="nav-link effect-5" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/subscription') }}">Abonnementen</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/home#contact-section-seven') }}">Contact</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/placepublication') }}">Aanleveren</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/information') }}">Informatie</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center">
        <span>© <?php echo date("Y"); ?> Keiennieuws Copyright.</span>
    </div>
</footer>