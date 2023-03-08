let url = window.location.href;
let tmp = url.split('/');
tmp.pop();
let globalUrl = tmp.join('/');

let tableA;
let map;
let polygonLayer;

function table(province = null, city = null) {
	let tmpUrl = globalUrl + '/article';
	if (province) {
		tmpUrl += '?province=' + province;
	} else if (city) {
		tmpUrl += '?city=' + city;
	}
	tableA = $('#article').DataTable({
        ajax: {
            url: tmpUrl,
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
        ],
    });
}

function showMap(prov=null, city=null) {
	let tmpUrl = globalUrl + '/map'
	if (prov) tmpUrl += `?province=${prov}`
	else if (city) tmpUrl += `?city=${city}`
	map.removeLayer(polygonLayer);
	let tmpLayer = L.layerGroup();
	$.ajax({
		url: tmpUrl,
		type: 'GET',
		data: { },
		success: (res) => {
			res.forEach(function(article) {
				let geojson = JSON.parse(article.geojson);
				let articleCount = article.article_count;
				let polygon = L.geoJSON(geojson).addTo(tmpLayer);

				let articleCountElement = document.createElement('div');
				articleCountElement.innerHTML = `<b>${article.city}</b><br>Total Article(s): ${articleCount}`;

				polygon.bindPopup(articleCountElement);
			})
			polygonLayer = tmpLayer;
			polygonLayer.addTo(map)
		}
	})
}

function getListData(type) {
	let tmpUrl = globalUrl;
	if (type == 'prov') {
		tmpUrl += '/province'
	} else if (type == 'kab') {
		tmpUrl += '/city'
	}

	$.ajax({
		url: tmpUrl,
		type: 'GET',
		data: { },
		success: (res) => {
			let html = "";
			res.forEach((area) => {
				html += `<option value="${area.shapename}">`
			})

			$('#list-area').html(html)
		}
	})
}

$(document).ready(() => {
	map = L.map('map').setView([-1.648, 117.225], 5);
	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    maxZoom: 19,
	    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
	polygonLayer = L.layerGroup();

	showMap(null, null)
	table(null, null)

	$('#scope-filter').change(() => {
		if ($('#scope-filter').val() == 'all') {
			tableA.destroy()
			showMap(null, null)	
			table(null, null)
			$('#list-area').html('')
		} else {
			getListData($('#scope-filter').val())
		}
	})

	$('#search-btn').click(() => {
		if ($('#scope-filter').val() == 'prov') {
			tableA.destroy()
			showMap($('#area-filter').val(), null)
			table($('#area-filter').val(), null)
		} else if ($('#scope-filter').val() == 'kab') {
			tableA.destroy()
			showMap(null, $('#area-filter').val())
			table(null, $('#area-filter').val())
		} else {
			tableA.destroy()
			showMap(null, null)
			table(null, null)
		}
	})
})