<script src="{{asset('theme/frontend/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('theme/frontend/dist/js/jquery.dataTables.min.js')}}" defer></script>
<!-- Bootstrap 4 -->
<script src="{{asset('theme/frontend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('theme/frontend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('theme/frontend/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('theme/frontend/dist/js/demo.js')}}"></script>
<script src="{{asset('ckeditor/config.js')}}"></script>
<script>
    CKEDITOR.replace( 'detail');
    CKEDITOR.replace( 'content');
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<!-- Page specific script -->
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
