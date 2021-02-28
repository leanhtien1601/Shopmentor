@extends('layouts.Admin-home2')
@section('title','Thêm danh mục')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tỉnh thành phố</label>
                                    <select class="form-control select2 choose city" style="width: 100%;" name="city"
                                            id="city">
                                        <option value="">-- Chọn tỉnh thành phố --</option>
                                        @foreach($allCity as $city)
                                            <option value="{{$city->matp}}">{{$city->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Quận huyện</label>
                                    <select class="form-control select2 choose district" style="width: 100%;"
                                            name="district"
                                            id="district">

                                        <option value="">-- Chọn quận huyện --</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Xã phường</label>
                                    <select class="form-control select2  ward" style="width: 100%;" name="ward"
                                            id="ward">

                                        <option value="">-- Chọn xã phường --</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiền ship</label>
                                    <input type="text" class="form-control fee_feeship"
                                           placeholder="Nhập số " name="fee_feeship">
                                    @error('fee_feeship')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary add-insert">Tải lên</button>
                                <button class="btn btn-primary" onclick="stepper.previous()">Huỷ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script_view')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var matp = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = "";
                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'ward';
                }
                $.ajax({
                    url: '{{route('select.city')}}',
                    method: 'POST',
                    data: {
                        action: action,
                        _token: _token,
                        matp: matp
                    },
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                })
            })
        });
        $('.add-insert').click(function () {
            var city = $('.city').val();
            var district = $('.district').val();
            var ward = $('.ward').val();
            var fee_feeship = $('.fee_feeship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{route('feedShip.insert')}}',
                method: 'POST',
                data: {
                    city: city,
                    district: district,
                    ward: ward,
                    fee_feeship: fee_feeship,
                    _token: _token
                },
                success: function (data) {
                    alert('Thêm phí thành công');
                }
            })

        });
    </script>
@endsection
