<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center">
            
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0 ">
                    <li class="list-inline-item text-black">
                        Copyright &copy; 2022 - {{ date('Y', strtotime(now()))}}
                        <span class="fw-bold ">{{config('tablar.bottom_title', 'TabLar')}}</span>.
                        {{__('All rights reserved.')}}
                    </li>
                    <li class="list-inline-item text-black">
                        <span class="fw-bold">
                            {{config('tablar.current_version', '1.0')}}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
