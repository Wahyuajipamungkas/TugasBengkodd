@extends('layouts.app')

@section('content')
<section class="content">
    <h1 class="text-gray font-bold p-3">Dashboard</h1>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                       <h3>{{ $jumlahPeriksa }}</h3>
                        <p>Jumlah Sudah Diperiksa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('dokter.periksa.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $jumlahObat }}</h3>
                        <p>Jumlah Obat</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('dokter.obat.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
        </div>
        
    </div><!-- /.container-fluid -->
</section>
@endsection
