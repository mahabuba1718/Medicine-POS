<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $system = \App\Models\Setting::find(1);
    @endphp
    <title>{{$system->sitename}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('uploads/setting/'.$system->favicon)}}" type="image/x-icon">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="assets/backend/css/home.css" type="text/css" />
</head>

<body>
    <section id="home">
        <div class="container-fluid d-flex justify-content-start align-items-center" style="height: 100vh;">
            <div class="section-title  m-lg-5 m-md-3 m-sm-1">
                <img class="ml-5 img-fluid" src="{{asset('/uploads/setting/'.$system->logo)}}" alt="logo" style="width: 120px;">
                <h2 class="font-weight-bolder mb-3">{{$system->pharmacyname}}</h2>
                <div class="row needs-validaion" novalidate>
                    <div class="col-lg-12">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        @if(session()->has('fail'))
                        <div class="alert alert-danger">
                            {{ session()->get('fail') }}
                        </div>
                        @endif
                        <form action="{{route('login_post')}}" method="POST">
                            @csrf
                            <div class="form-group mb-1">
                                <label for="email" class="form-label font-weight-bold">Email</label>
                                <input type="email" for="email" name="email" class="form-control" id="email"
                                    placeholder="Mark@gmail.com" value="{{old('email')}}" required>
                            </div>
                            <div class="form-group  mb-1">
                                <label for="password" class="form-label font-weight-bold">Password</label>
                                <input type="password" for="password" class="form-control" name="password"
                                    placeholder="Enter your password " required>
                            </div>

                            
                            <div class="form-group mt-3 text-center text-light">
                                <button type="submit" class="btn btn-block btn-md text-light mt-4" style="background-color: #418975;">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <div class="text-center text-lg-start" style="font-size: 20px;">
                            <p class="small fw-bold mb-0">Don't have an account? <a href="{{route('registration')}}"
                                    class="link-danger">Register</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="footer mt-auto py-3">
        <div class="row text-white">
            <div class="col-lg-12 text-center mb-2 mb-lg-0">
                <p class="mb-1 mt-1 ">Copyright&copy; Medicine Shop POS. All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</body>

</html>
