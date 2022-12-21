<style>
.sidebar {
    top: 0rem;
}
.me-5{
    margin-right: 7rem!important;
}
.logo{
    font-family: 'Handlee', cursive;
}
</style>

<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow d-print-none" style="background-color: #008080;">


    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-center" href="{{route('dashboard')}}">
        <img class="mr-auto " src="{{asset('/uploads/setting/'.$system->logo)}}" alt="logo" style="width: 45px; height: 45px;">
        <span class="logo">{{$system->pharmacyname}}</span>
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="dropdown  me-5">
        <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if(auth()->user()->image == null)
            <img src="{{asset('assets/backend/img/med.webp')}}" alt="image" class="rounded-circle mr-1" style="width: 30px;">
            @else
            <img src="{{asset('uploads/pharmacist/'.auth()->user()->image)}}" alt="image" class="rounded-circle mr-1" style="width: 45px;">
            @endif
        </button>
        <ul class="dropdown-menu">
            <li  class="p-2">
                <a class="dropdown-item" href="{{route('profile')}}">
                    <i class="far fa-user"></i>
                        Profile
                </a>
            </li>
            @if(auth()->user()->role_id == 1)
            <li class="p-2">
                <a class="dropdown-item" href="{{route('setting')}}">
                    <i class="fas fa-cog"></i>
                        Settings
                </a>
            </li>
            @endif
            <li><hr class="dropdown-divider"></li>
            <li class="p-2">
                <a class="dropdown-item  text-danger" href="{{route('logout')}}">
                <i class="fas fa-sign-out-alt"></i>
                        Logout
                </a>
            </li>
        </ul>
    </div>

</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
