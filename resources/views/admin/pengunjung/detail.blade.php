@extends('admin.layouts.app')
@push('css')

@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$template->title}}                
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.pengunjung.index')}}"><i class="fa fa-check"></i> Index Pengunjung</a></li>
                <li class="active">Detail Pengunjung</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title"><i class="{{$template->icon}}"></i> Detail Pengunjung</h3>                            
                        </div>
                        <div class="box-body">  
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:200px"></th>
                                        <th style="width:20px"></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama Pengunjung</td>
                                        <td>:</td>
                                        <td>{{$pengunjung->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Pengunjung</td>
                                        <td>:</td>
                                        <td>{{$pengunjung->alamat}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{$pengunjung->email}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </br>
                            </br>
                            <h4 align="center"> Daftar Tiket Pengunjung</h4>
                            <table class="table table-striped" id="datatables">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama / Jadwal Kecak</td>
                                        <td>Harga Tiket</td>
                                        <td>Tanggal Pesan</td>
                                        <td>Jumlah Pesan</td>
                                        <td>Total Bayar</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($pemesanan as $key => $value)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$value->nama_kecak.' / '.date("d F Y", strtotime($value->jadwal))}}</td>
                                            <td>{{$value->harga}}</td>
                                            <td>{{ date("d F Y", strtotime($value->tanggal_pesan))}}</td>
                                            <td>{{$value->jumlah}} tiket</td>
                                            <td>{{$value->total}}</td>
                                            <td>
                                                @if($value->status == 1)
                                                    Terkonfirmasi
                                                @else
                                                    Belum Terkonfirmasi
                                                @endif
                                            </td>
                                        </tr>
                                        @php 
                                            $no++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">                                
                            <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
           </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('js')
    <!-- page script -->
    <script>
        $(function () {
            $('#datatables').DataTable()
            $('#full-datatables').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })
    </script>
@endpush