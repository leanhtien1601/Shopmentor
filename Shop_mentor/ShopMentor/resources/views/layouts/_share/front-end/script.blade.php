<script src="{{asset('theme/frontend/js/jquery-3.5.1.min.js')}}" type="text/javascript" defer></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('theme/frontend/js/bootstrap.min.js')}}" type="text/javascript" defer></script>
<script src="{{asset('theme/frontend/js/sweetalert.js')}}" type="text/javascript" defer></script>
<script src="{{asset('theme/frontend/js/wow.min.js')}}" type="text/javascript" defer></script>
<script src="{{asset('theme/frontend/js/swiper-bundle.min.js')}}" type="text/javascript" defer></script>
<script src="{{asset('theme/frontend/js/script.js')}}" type="text/javascript" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" defer>
    $('#keywords').keyup(function () {
        var query = $(this).val();
        if (query !== '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{route('product.search')}}",
                method: "POST",
                data: {query: query, _token: _token},
                success: function (data) {
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        } else {
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click', '.li_search_ajax', function () {
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>
