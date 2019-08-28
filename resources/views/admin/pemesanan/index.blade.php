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
                <li class="active">{{$template->title}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <div class="row">
               <div class="col-md-12">
                    {!!Alert::showBox()!!}
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title"><i class="{{$template->icon}}"></i> List {{$template->title}}</h3>
                            {{-- <a href="{{route("$template->route".'.create')}}" class="btn btn-primary pull-right">
                                <i class="fa fa-pencil"></i> Tambah {{$template->title}}
                            </a> --}}
                        </div>
                        <div class="box-body">
                            <table class="table table-striped" id="datatables">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Pengunjung</td>
                                        <td>Nama Kecak</td>
                                        <td>Tanggal Pesan</td>
                                        <td>Jumlah</td>
                                        <td>Status Konfirmasi</td>
                                        <td>Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($data as $key => $value)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$value->nama_pengunjung}}</td>
                                        <td>{{$value->nama_kecak}}</td>
                                        <td>{{date("d F Y", strtotime($value->tanggal_pesan))}}</td>
                                        <td>{{$value->jumlah_pesan}}</td>
                                        <td>
                                            @if($value->status_pesan == 0)
                                                Belum Terkonfirmasi
                                            @elseif($value->status_pesan == 1)
                                                Terkonfirmasi
                                            @elseif($value->status_pesan == 2)
                                                Pemesanan Dibatalkan    
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status_pesan == 0)
                                                <a href="{{route("$template->route".'.konfirmasi',[$value->pemesanan_id])}}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil"></i> Konfirmasi</a>
                                            @else
                                                <a href="{{route("$template->route".'.konfirmasi',[$value->pemesanan_id])}}" class="btn btn-success btn-sm btn-block"><i class="fa fa-file-text"></i> Detail Ticket</a>
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