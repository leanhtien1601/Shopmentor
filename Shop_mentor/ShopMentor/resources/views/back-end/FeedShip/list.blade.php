@extends('layouts.Admin-home2')
@section('title','Danh sách danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bảng phí vận chuyển</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách phí</h3>
                        </div>
                        <div class="navbar-search-block mt-3 ml-4">
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thành phố</th>
                                    <th>Tên quận huyện</th>
                                    <th>Tên xã phường</th>
                                    <th>Phí ship</th>
                                    <th>Trạng thái</th>
                                    <th>
                                        <a href="{{route('feedShip.add')}}" class="btn btn-success">Tạo mới</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allShip as $k => $row)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td>
                                            {{$row->city->name_city}}
                                        </td>
                                        <td>
                                            {{$row->dirty->name_quanhuyen}}
                                        </td>
                                        <td>
                                            {{$row->wrad->name_xaphuong}}
                                            </td>
                                        <td>{{$row->fee_feeship}}<sup>đ</sup> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
