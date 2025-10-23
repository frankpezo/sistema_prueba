@if ($message = Session::get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ $message }}"
            });

        });
    </script>
@endif

@if ($message = Session::get('logoutSession'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Swal.fire({
                position: "center",
                icon: "info",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 4000
            });



        });
    </script>
@endif







@if ($message = Session::get('danger'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $message }}",
                showConfirmButton: false,
                timer: 4000
                /* footer: '<a href="#">Why do I have this issue?</a>' */
            });
        });
    </script>
@endif
