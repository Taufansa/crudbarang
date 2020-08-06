@extends('layout/main')

@section('title','Daftar Barang')

@section('container')

<div class="container">
    
    <h3 class="text-center mt-5">Daftar Barang</h3>
    <br>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>{{ session('fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="/search" method="post">
        @csrf
        <div class="">
            <input type="text" id="search" name="search" class="form-control form-control-sm" placeholder="Cari Barang">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary btn-sm mt-2 mb-2" id="searchbutton">Cari</button>
                <button type="button" class="btn btn-info btn-sm ml-2 mb-2 mt-2" data-toggle="modal" data-target="#exampleModal">
                Tambah Barang
                </button>
            </div>
        </div>
    </form> 
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Nomer</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Foto Barang</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $brg => $barang)
                    <tr>
                        <th scope="row">{{ $barangs->firstItem() + $brg}}</th>
                        <td>{{$barang->nama_barang}}</td>
                        <td>{{$barang->harga_beli}}</td>
                        <td>{{$barang->harga_jual}}</td>
                        <td>{{$barang->stok}}</td>
                        <td>
                        <img src="/img/{{$barang->foto_barang}}" alt="{{$barang->foto_barang}}" height="40"width="40"/>
                        </td>
                        <td>
                        <a href="/edit/{{$barang->id_barang}}" class="badge badge-info">Update</a>
                        <form action="/delete/{{$barang->id_barang}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class ="badge badge-danger" onclick ="return confirm('are you sure?');">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div style="margin-top: -30px;">
        {{$barangs->links()}}
    </div>
    <br>
    <br>
    <br>
    <div class="footer">
        <p class="text-center" style="font-size: 12px;">Taufan Samudra Akbar ⓒ 2020</p>
        <p class="text-center" style="font-size: 12px; margin-top: -15px;">Fitur live search (asynchronous) error, jadi saya pake search dengan button (synchronous)</p>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/tambahbarang" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Nama Barang" name="nama_barang" value="{{old('nama_barang')}}">
                    @error('nama_barang')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    <br>
                    <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Harga Beli"
                    name="harga_beli" value="{{old('harga_beli')}}">
                    @error('harga_beli')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    <br>
                    <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Harga Jual"
                    name="harga_jual" value="{{old('harga_jual')}}">
                    @error('harga_jual')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    <br>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Stok"
                    name="stok" value="{{old('stok')}}">
                    @error('stok')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    <br>
                    <label for="exampleFormControlFile1">Foto Barang</label>
                    <input type="file" class="form-control-file @error('foto_barang') is-invalid @enderror" id="exampleFormControlFile1" name="foto_barang">
                    <span>Format: jpg/png. Max size: 100kb</span>
                    @error('foto_barang')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror

                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submmit" class="btn btn-primary">Tambah Barang</button>
            </form>
        </div>
        </div>
    </div>
    </div>

</div>
@endsection

@section('script')
    <!-- <script type="text/javascript">
        //live search

        var search = document.getElementById('search');
        var searchbutton = document.getElementById('searchbutton');
        var container = document.getElementById('container');

        search.addEventListener('keyup', function(){
            var searchQuest = $(this).val();
            $.ajax({
                method: 'GET',
                url: '/livesearch',
                dataType: 'json',
                data:{
                    '_token' : '{{csrf_token()}}',
                    searchQuest: searchQuest
                },
                success: function(res){
                    var tableRow = '';
                    $('#container').html('');
                    $.each(res, function(index, value){
                        tableRow = "<tr>
                                        <th scope='row'>+ barangs.firstItem() + brg+</th>
                                        <td>+value.nama_barang+</td>
                                        <td>+value.harga_beli+</td>
                                        <td>+value.harga_jual+</td>
                                        <td>+value.stok+</td>
                                        <td>+value.foto_barang+</td>
                                        <td>
                                        <a href='/edit/+value.id_barang+' class='badge badge-info'>Update</a>
                                        <form action='/delete/+value.id_barang+' method='post'>
                                            @method('delete')
                                            @csrf
                                            <button type='submit' class ='badge badge-danger' onclick ='return confirm("are you sure?");'>Delete</button>
                                        </form>
                                        </td>
                                    </tr>";
                        $('#container').append();
                    });
                }
            });
        });


    </script> -->
@endsection
