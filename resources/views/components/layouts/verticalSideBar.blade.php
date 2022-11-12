 <div class="vertical-side-bar col-md-auto bg-light sticky-top">
     <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
         <ul class="nav nav-pills nav-flush flex-md-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
             <li class="nav-item">
                 <a href="/dashboard/person-information" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                     <div class="row">
                         <i class="fs-1 bi bi-person-square text-dark"></i>
                         <span class="ms-1 d-none d-sm-inline text-dark">Gegevens</span>
                     </div>
                 </a>
             </li>
             <li>
                 <a href="/dashboard/person-reservations" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                     <div class="row">
                         <i class="fs-1 bi bi-newspaper text-dark"></i>
                         <span class="ms-1 d-none d-sm-inline text-dark">Reserveringen/Bookingen</span>
                     </div>
                 </a>
             </li>
             <li>
                 <a href="/dashboard/person-security" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                     <div class="row">
                         <i class="fs-1 bi bi-shield-lock text-dark"></i>
                         <span class="ms-1 d-none d-sm-inline text-dark">Email/Wachtwoord</span>
                     </div>
                 </a>
             </li>
         </ul>
         @guest
         <hr style="border: 1px #6c757d solid !important; opacity: 1; width: 100%; margin: auto; margin-top: 5%; margin-bottom: 5%;">

         @else

         @endguest



     </div>
 </div>