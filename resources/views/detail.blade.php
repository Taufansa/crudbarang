@extends('layout/main')

@section('title','Detail Barang')

@section('container')
<div class="container">

    <h3 class="text-center mt-5">Detail Barang</h3>

    <form action="/update/{{$barang->id_barang}}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Nama Barang</label>
            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Nama Barang" value="{{$barang->nama_barang}}" name="nama_barang">
            @error('nama_barang')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror   
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Harga Beli</label>
            <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Harga Beli"
            value="{{$barang->harga_beli}}" name="harga_beli">
            @error('harga_beli')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror 
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Harga Jual</label>
            <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Harga Jual" value="{{$barang->harga_jual}}" name="harga_jual">
            @error('harga_jual')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror 
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Stok</label>
            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Stok" value="{{$barang->stok}}" name="stok">
            @error('stok')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror 
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Gambar Produk</label>
            <br>
            <img src="/img/{{$barang->foto_barang}}" alt="{{$barang->foto_barang}}" height="80"width="80"/>
            <input type="file" class="form-control @error('foto_barang') is-invalid @enderror" id="exampleFormControlInput1" name="foto_barang" value="{{$barang->foto_barang}}">
            @error('foto_barang')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-info">Update</button>
            <a href="/" class="btn btn-warning ml-2">Back</a>
        </div>

    </form>

</div>
@endsection