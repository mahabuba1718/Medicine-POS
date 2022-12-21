<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/backend/img/Pill.png" type="image/x-icon">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="assets/backend/css/registration.css" type="text/css" />
   
</head>

<body>
    <section class="vh-100 bg-image"
        style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-4">Create an account</h2>

                                <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form3Example1cg">Name: </label>
                                        <input type="text" for="form3Example1cg" id="form3Example1cg" name="name"
                                            placeholder="Enter Your Name" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form3Example3cg">E-mail:</label>
                                        <input type="email" for="form3Example3cg" id="form3Example3cg" name="email"
                                            placeholder="Enter Your E-mail" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form3Example5cg">Phone:</label>
                                        <input type="tel" for="form3Example5cg" id="form3Example5cg" name="phone"
                                            placeholder="Enter Your Phone Number"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="form3Example4cg">Password:</label>
                                        <input type="password" for="form3Example4cg" id="form3Example4cg"
                                            name="password" placeholder="Enter Your Password"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example6cg">Image:</label>
                                        <input type="file" for="form3Example6cg" id="form3Example6cg" name="image"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-block btn-lg text-light"
                                            style="background-color:#25aa9e">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#"
                                            class="fw-bold text-body">
                                            <u>
                                                <a href="{{route('master')}}" class="link-danger">
                                                    Login here
                                                </a>
                                            </u>
                                    </p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>