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
                <li><a href="{{route('admin.pemesanan.index')}}"><i class="fa fa-check"></i> Index Konfirmasi</a></li>
                <li class="active">Konfirmasi Tiket</li>
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
                            <h3 class="box-title"><i class="{{$template->icon}}"></i> Konfirmasi Pemesanan Tiket</h3>                            
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
                                        <td>KodeTiket</td>
                                        <td>:</td>
                                        <td>{{'#'.str_pad($data->id,6,"0",STR_PAD_LEFT)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kecak Yang Dipesan / Jadwal</td>
                                        <td>:</td>
                                        <td>{{$data->nama_kecak." / $data->jadwal_kecak"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pengunjung</td>
                                        <td>:</td>
                                        <td>{{$data->nama_pengunjung}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tiket</td>
                                        <td>:</td>
                                        <td>{{$data->jumlah}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td>:</td>
                                        <td>{{$data->jumlah}} x {{$data->harga}} = {{$data->total}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pesan Tiket</td>
                                        <td>:</td>
                                        <td>{{date("d F Y",strtotime($data->tanggal_pesan))}}</td>
                                    </tr>
                                    <tr>
                                        <td>Rekening Transfer / Bank</td>
                                        <td>:</td>
                                        <td>{{$data->no_rekening.' / '.$data->nama_bank}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Pembayaran</td>
                                        <td>:</td>
                                        <td><a href="{{url('storage/'.$data->bukti_transfer)}}" target="blank" alt="Image" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Bukti Transfer</a></td>
                                    </tr>
                                    @if($data->status == 0)               
                                        <tr>           
                                            <td colspan="3">
                                                <form action="{{route("$template->route".'.update',[$data->id])}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{$data->nama_pengunjung}}" name="nama_pengunjung">
                                                    <input type="hidden" value="{{Auth::guard('admin')->user()->id}}" name="id_user">
                                                    <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil"></i> Konfirmasi Pembayaran</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif    
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