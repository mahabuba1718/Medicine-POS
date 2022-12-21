<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse d-print-none">
      <div class="position-sticky pt-3 sidebar-sticky" style="background-color: #93c7bc;">
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Home</span>
          <a class="link-secondary" href="{{route('master')}}" aria-label="Add a new report">
            <span data-feather="home" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column">
          
          <li class="nav-item">
              <a class="nav-link active"  aria-current="page" href="{{route('dashboard')}}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
        </ul>
        <hr>
         <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>People</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="user" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column">
         <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('contact_pharmacist')}}">
              <i class="fa-solid fa-user-doctor "></i>
               Pharmacist
            </a>
          </li>         
         <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('contact_customer')}}">
              <i class="fa-solid fa-user "></i>
               Customer
            </a>
          </li>         
         <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('contact_supplier')}}">
              <i class="fa-solid fa-truck-field"></i>
              Supplier
            </a>
          </li>
              
        </ul>
        <hr>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Medicine</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="tablet" class="align-text-bottom"></span>
          </a>
        </h6>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('category')}}">
              <i class="fa-solid fa-square-poll-horizontal"></i>
              Category
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('unit')}}">
              <i class="fa-solid fa-pen-fancy"></i>
              Unit
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('type')}}">
              <i class="fa-solid fa-cube"></i>
              Type
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('medicine')}}">
              <i class="fa-solid fa-capsules"></i>
              Medicine
              </a>
            </li>
          </ul>
          <hr>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Purchase</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="shopping-cart" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('purchase')}}">
              <i class="fa-solid fa-cart-shopping"></i>
              Purchase
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('add_purchase')}}">
              <i class="fa-solid fa-bag-shopping"></i>
              Add Purchase
            </a>
          </li>
        </ul>
        <hr>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Sale</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="activity" class="align-text-bottom"></span>
            </a>
            </h6>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{route('pos')}}">
                  <i class="fa-brands fa-sellsy"></i>
                  POS
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{route('possale')}}">
                  <i class="fa-brands fa-salesforce"></i>
                  POS Sale
                  </a>
                <!-- </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#">
                  <i class="fa-solid fa-file-invoice"></i>
                  Invoice
                  </a>
                </li> -->

              </ul>
              <hr>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Account</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="dollar-sign" class="align-text-bottom"></span>
            </a>
            </h6>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('account_expense')}}">
                <i class="fa-solid fa-bag-shopping"></i>
                Expenses
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('account_income')}}">
                <i class="fa-solid fa-money-check-dollar"></i>
                Income
                </a>
              </li>
            </ul>
            <hr>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Report</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
            </a>
            </h6>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{route('stock_report')}}">
                  <i class="fa-solid fa-money-bill-trend-up"></i>
                  Stock Report
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{route('expiry_report')}}">
                  <i class="fa-solid fa-xmark"></i>
                  Expired Medicine Report
                  </a>
                </li>
              </ul>
              <hr>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Settings</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="settings" class="align-text-bottom"></span>
            </a>
            </h6>
            <ul class="nav flex-column mb-5">
              <li class="nav-item ">
                  <a class="nav-link" href="{{route('setting')}}">
                  <span data-feather="settings" class="align-text-bottom"></span>
                    Settings</a>
              </li>
            </ul>


        <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Year-end sale
            </a>
          </li>
        </ul> -->
      </div>
</nav>