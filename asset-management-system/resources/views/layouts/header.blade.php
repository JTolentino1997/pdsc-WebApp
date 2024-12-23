<nav class="navbar navbar-expand px-4 py-3">
    <form action="#" class="d-none d-sm-inline-block">

    </form>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="" data-bs-toggle="dropdown" class="nav-icon pe-md-0  d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0e2238" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                      </svg> 

                      <span class="ms-2 justify-content-center text-black">{{ strtoupper(auth()->user()->name)}}</span>
                </a> 
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <ul>
                        <li>
                            <a href="{{ route('logout') }}" class="d-flex align-items-center">
                                <i class="lni lni-exit me-2"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                    
                    
                </div>
            </li>
        </ul>
    </div>
</nav>
