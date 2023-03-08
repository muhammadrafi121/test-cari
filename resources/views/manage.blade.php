@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="col">
            <div class="row my-4">
                <div class="col">
                    <button class="btn btn-md btn-primary" id="add-btn" onclick="addData()"><i class="bi bi-plus"></i>Tambah
                        Data</button>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-lg" tabindex="-1" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Data Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Artikel</label>
                                    <input name="title" type="text" class="form-control" id="title" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="authors" class="form-label">Penulis</label>
                                    <input name="authors" type="text" class="form-control" id="authors" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="keyword" class="form-label">Keyword</label>
                                    <input name="keyword" type="text" class="form-control" id="keyword" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Tanggal Publikasi</label>
                                    <input name="date" type="date" class="form-control" id="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="journal" class="form-label">Jurnal</label>
                                    <input name="journal" type="text" class="form-control" id="journal" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="doi" class="form-label">DOI</label>
                                    <input name="doi" type="text" class="form-control" id="doi" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="province" class="form-label">Provinsi</label>
                                    <input class="form-control" list="list-provinsi" id="province" name="province" required placeholder="Type to search...">
                                    <datalist id="list-provinsi">
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->shapename }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Kota</label>
                                    <input class="form-control" list="list-kota" id="city" name="city" required placeholder="Type to search...">
                                    <datalist id="list-kota">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->shapename }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="abstract" class="form-label">Abstrak</label>
                                    <textarea name="abstract" id="abstract" cols="30" rows="10" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-lg" tabindex="-1" id="detail-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detail-modal-title">Detail Data Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-title" class="form-label">Judul Artikel</label>
                                <input type="text" class="form-control" id="detail-title" name="title" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-authors" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="detail-authors" name="authors" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-keyword" class="form-label">Keyword</label>
                                <input type="text" class="form-control" id="detail-keyword" name="keyword" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-date" class="form-label">Tanggal Publikasi</label>
                                <input type="text" class="form-control" id="detail-date" name="date" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-journal" class="form-label">Jurnal</label>
                                <input type="text" class="form-control" id="detail-journal" name="journal" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-doi" class="form-label">DOI</label>
                                <input type="text" class="form-control" id="detail-doi" name="doi" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="detail-province" name="province"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="detail-city" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="detail-city" name="city" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="detail-abstract" class="form-label">Abstrak</label>
                                <textarea name="abstract" id="detail-abstract" cols="30" rows="10" class="form-control" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
