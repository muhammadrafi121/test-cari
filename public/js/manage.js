let url = window.location.href;
let tmp = url.split('/');
tmp.pop();
let globalUrl = tmp.join('/');

let table;

function addData() {
    $('#modal-title').html('Tambah Data Artikel');

    $('#edit-form').attr('method', 'POST');

    $('#title').val('')
    $('#authors').val('')
    $('#keyword').val('')
    $('#date').val('')
    $('#journal').val('')
    $('#doi').val('')
    $('#province').val('')
    $('#city').val('')
    $('#abstract').val('')

    $('#edit-modal').show();

    $('#edit-form #submit').click(() => {
        if ($('#edit-form').attr('method') == 'POST') {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            $.ajax({
                url: globalUrl + '/article',
                type: 'POST',
                data: {
                    _token  : csrfToken,
                    title   : $('#title').val(),
                    authors : $('#authors').val(),
                    keyword : $('#keyword').val(),
                    date    : $('#date').val(),
                    journal : $('#journal').val(),
                    doi     : $('#doi').val(),
                    province: $('#province').val(),
                    city    : $('#city').val(),
                    abstract: $('#abstract').val(),
                },
                success: (res) => {
                    $('#edit-modal').hide();
                    table.ajax.reload();
                    Swal.fire(
                        'Ditambah!',
                        'Data berhasil ditambahkan.',
                        'success'
                    );
                }
            })
        }
    })
}

function editData(id) {
    $('#modal-title').html('Edit Data Artikel');

    $('#edit-form').attr('method', 'PUT');

    $.ajax({
        url: globalUrl + '/article/' + id,
        type: 'GET',
        data: { },
        success: (res) => {
            $('#title').val(res.title)
            $('#authors').val(res.authors)
            $('#keyword').val(res.keyword)
            $('#date').val(res.date)
            $('#journal').val(res.journal)
            $('#doi').val(res.doi)
            $('#province').val(res.province)
            $('#city').val(res.city)
            $('#abstract').val(res.abstract)

            $('#edit-modal').show();
        }
    })

    $('#edit-form #submit').click(() => {
        if ($('#edit-form').attr('method') == 'PUT') {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            $.ajax({
                url: globalUrl + '/article/' + id,
                type: 'PUT',
                data: {
                    _token  : csrfToken,
                    title   : $('#title').val(),
                    authors : $('#authors').val(),
                    keyword : $('#keyword').val(),
                    date    : $('#date').val(),
                    journal : $('#journal').val(),
                    doi     : $('#doi').val(),
                    province: $('#province').val(),
                    city    : $('#city').val(),
                    abstract: $('#abstract').val(),
                },
                success: (res) => {
                    $('#edit-modal').hide();
                    table.ajax.reload();
                    Swal.fire(
                        'Diupdate!',
                        'Data berhasil diupdate.',
                        'success'
                    );
                }
            })
        }
    })
}

function detailData(id) {
    $.ajax({
        url: globalUrl + '/article/' + id,
        type: 'GET',
        data: { },
        success: (res) => {
            $('#detail-title').val(res.title)
            $('#detail-authors').val(res.authors)
            $('#detail-keyword').val(res.keyword)
            $('#detail-date').val(res.date)
            $('#detail-journal').val(res.journal)
            $('#detail-doi').val(res.doi)
            $('#detail-province').val(res.province)
            $('#detail-city').val(res.city)
            $('#detail-abstract').val(res.abstract)

            $('#edit-modal').show();
        }
    })

    $('#detail-modal').show();
}

function deleteData(id) {
    Swal.fire({
        title: 'Yakin?',
        text: "Data yang telah dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                url: globalUrl + '/article/' + id,
                type: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: (res) => {
                    table.ajax.reload();
                    Swal.fire(
                        'Dihapus!',
                        'Data berhasil dihapus.',
                        'success'
                    )
                }
            })
        }
    })
}

$(document).ready(function () {
    
    table = $('#article').DataTable({
        ajax: {
            url: globalUrl + '/article',
            type: 'GET',
            data: (d) => { },
        },
        columns: [
			{
				"data": null,
				"render": (data, type, row, meta) => {
					return meta.row + 1;
				}
			},
            {
                data: "title",
                "target": 0
            },
            {
                data: "authors",
                "target": 1
            },
            {
                data: "keyword",
                "target": 2
            },
            {
                data: "date",
                "target": 3
            },
            {
                data: "journal",
                "target": 4
            },
            {
                data: "province",
                "target": 5
            },
            {
                data: "city",
                "target": 6
            },
            {
                data: "doi",
                "target": 7
            },
            {
                data: { id: "id" },
                "width": "15%",
                "render": (data) => {
                    let actBtn = `
                        <center>
                            <button type="button" class="btn btn-circle bg-success detail-btn"
                                onclick="detailData(${data.id})"><i
                                    class="bi bi-info-lg"></i></button>
                            <button type="button" class="btn btn-circle bg-warning edit-btn"
                                onclick="editData(${data.id})"><i
                                    class="bi bi-pencil-fill"></i></button>
                            <button type="button" class="btn btn-circle bg-danger delete-btn"
                            onclick="deleteData(${data.id})"><i
                                    class="bi bi-trash3-fill"></i></button>
                        </center>
                    `;
                    return actBtn;
                },
                "target": 8
            },
        ]
    });
    
    $('.btn-close').click(() => {
        $('.modal').hide();
    })
});