@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="col">
            <div class="row my-4">
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <select class="input-group-text" id="scope-filter">
                            <option value="all">Seluruh Data</option>
                            <option value="prov">Data Provinsi</option>
                            <option value="kab">Data Kab/Kota</option>
                        </select>
                        <input type="text" class="form-control" list="list-area" aria-describedby="search-btn" id="area-filter">
                        <datalist id="list-area"></datalist>
                        <button class="btn btn-outline-secondary" type="button" id="search-btn"><i
                                class="bi bi-search"></i></button>

                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <div id="map"></div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <h2>Daftar Artikel Ilmiah</h2>
                </div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <table class="table table-responsive" style="width: 100%" id="article">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kata Kunci</th>
                                <th>Tanggal Publikasi</th>
                                <th>Jurnal Ilmiah</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>DOI</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
