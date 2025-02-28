@include('layout.header')

<div class="container mt-5">
    <div class="row justify-content-center">
        @yield('content')
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#datetimepicker").persianDatepicker({
            format: 'YYYY/MM/DD HH:mm', // فرمت تاریخ و زمان
            timePicker: {
                enabled: true, // فعال‌سازی انتخاب زمان
                meridiem: {
                    enabled: true // نمایش AM/PM
                }
            }
        });
    });
</script>
@include('layout.footer')
