@props(['name'])


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<link id="bs-css" href="{{ asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css"
    rel="stylesheet">
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"
    integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw=="
    crossorigin="anonymous"></script>

<!-- Datepicker -->
<div class='input-group date mt-1' id='datetimepicker1'>
    <input type='text' placeholder="dd - mm - yyyy" id="{{$name}}" name="{{$name}}" required readonly class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </span>
</div>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datepicker({
            format: "dd-mm-yyyy",
            weekStart: 0,
            language: "es",
            autoclose: true,
            todayHighlight: true,
            orientation: "auto"

        });
    });

</script>

