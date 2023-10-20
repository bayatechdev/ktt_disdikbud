// kamus

$("#dots").hide();

$("#form_translate").on("submit", function (e) {
    e.preventDefault();
    let data = $("#form_translate").serialize();
    let token = $('input[name="_token"]').val();

    $(".translate_box").text("");
    $("#dots").show();
    $.ajax({
        url: "/translate",
        type: "POST",
        "X-CSRF-TOKEN": token,
        data: data,
        success: function (result) {
            translate(result);
        },
        error: function (xhr) {
            $(".translate_box").html(
                '<i class="text-secondary">tidak ditemukan</i>'
            );
            alert("Error: " + xhr.responseText);
        },
        complete: function () {
            $("#dots").hide();
        },
    });
});

function translate(data) {
    let bahasa = data.data.bahasa;
    let translate = data.data.translate.sort(
        (a, b) => a["word"].length - b["word"].length
    );

    bahasa = bahasa.split("-");

    $(".translate_box").append("<small><i>" + data.message + "</i></small>");

    $.each(translate, function (index, value) {
        let word = value["word"];
        let highlight = $("#word").val();

        word =
            highlight_text(word, highlight) +
            " <i>(" +
            bahasa[0].replace(" ", "") +
            ")</i>";
        trans =
            value["translate"] + " <i>(" + bahasa[1].replace(" ", "") + ")</i>";

        const para = document.createElement("p");
        para.innerHTML = "<div>" + word + "</div><div>" + trans + "</div>";
        $(".translate_box").append(para);

        if (index < translate.length - 1) $(".translate_box").append("<hr />");
    });
}

function highlight_text(text, highlight) {
    var innerHTML = text;
    var index = text.toLowerCase().indexOf(highlight.toLowerCase());

    if (index >= 0) {
        innerHTML =
            innerHTML.substring(0, index) +
            "<span>" +
            innerHTML.substring(index, index + highlight.length) +
            "</span>" +
            innerHTML.substring(index + highlight.length);

        return innerHTML;
    } else {
        return innerHTML;
    }
}

var dots = window.setInterval(function () {
    var wait = document.getElementById("dots");
    if (wait.innerHTML.length > 3) wait.innerHTML = "";
    else wait.innerHTML += ".";
}, 200);
// -----

var map = L.map("map", {
    zoomControl: true,
    scrollWheelZoom: false, // disable original zoom function
    smoothWheelZoom: true, // enable smooth zoom
    smoothSensitivity: 3, // zoom speed. default is 1
    fullscreenControl: true,
    fullscreenControlOptions: {
        position: "topright",
    },
}).setView([3.5636219380731027, 117.32076644897461], 10);

map.attributionControl.setPrefix("Leaflet");

// add maps google
googleHybrid = L.tileLayer(
    "http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}",
    {
        maxZoom: 20,
        attribution: "© Google Maps",
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
    }
).addTo(map);
googleStreets = L.tileLayer(
    "http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
    {
        maxZoom: 20,
        attribution: "© Google Maps",
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
    }
);
googleTerrain = L.tileLayer(
    "http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}",
    {
        maxZoom: 20,
        attribution: "© Google Maps",
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
    }
);
openStreet = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 20,
    attribution: "© OpenStreetMap",
});
noMaps = L.tileLayer("", {
    maxZoom: 20,
});

var baseLayers = {
    Satellite: googleHybrid,
    Streets: googleStreets,
    Terrain: googleTerrain,
    OpenStreet: openStreet,
    None: noMaps,
};

L.control
    .layers(baseLayers, null, {
        position: "bottomright",
    })
    .addTo(map);

// Desa Layer
fetch("/storage/assets/geojson/desa.geojson")
    .then((res) => res.json())
    .then((data) => {
        L.geoJson(data, {
            style: style,
            onEachFeature: onEachFeatureBaseLayer,
        }).addTo(map);
    });

function style(feature) {
    return {
        fillColor: "#fff",
        fillOpacity: 0,
        color: "#999",
        opacity: 0.7,
        weight: 1,
        dashArray: "3",
    };
}

function onEachFeatureBaseLayer(feature, layer) {
    layer.bindTooltip(feature.properties.popupContent, {
        // direction: "center",
        // opacity: 0.5
    });
    layer.on({
        mouseover: highlightFeatureBaseLayer,
        mouseout: resetHighlightBaseLayer,
    });
}

function highlightFeatureBaseLayer(e) {
    var layer = e.target;
    layer.setStyle({
        fillColor: "#AAA",
        fillOpacity: 0.2,
        weight: 2,
        // dashArray: '',
    });
}

function resetHighlightBaseLayer(e) {
    var layer = e.target;
    layer.setStyle(style());
}

// Maps
cagar_budaya_list();

function cagar_budaya_list() {
    $.ajax({
        url: "/cagar-budaya/list",
        success: function (result) {
            generate_maps(result);
        },
        error: function (xhr) {
            alert("Error: " + xhr.responseText);
        },
    });
}

function generate_maps(result) {
    result.forEach((element) => {
        $popup = popup_content(element);
        L.marker([element.koordinat_lat, element.koordinat_long])
            .bindPopup($popup, {
                maxWidth: 420,
            })
            .bindTooltip(element.nama_objek, {
                // direction: 'right'
            })
            .addTo(map);
    });
}

function generate_tabs_content(data) {
    $("#myTabContent #deskripsi").html(data.deskripsi);
    $("#myTabContent #kepemilikan").html(data.riwayat_kepemilikan);
    $("#myTabContent #sejarah").html(data.latar_sejarah);
    $("#myTabContent #lokasi").html(data.nama_tempat);
}

function generate_carousel(data) {
    let active = "active";
    $(".carousel .carousel-inner").html("");
    $(".carousel .carousel-indicators").html("");

    data.forEach((value, index) => {
        image =
            '<div class="carousel-item ' +
            active +
            '"><img class="d-block w-100" src="/storage/cagar-budaya/images/' +
            value.file +
            '" alt="gambar"></div>';
        indicator =
            '<li data-target="#carouselExampleControls" data-slide-to="' +
            index +
            '" class="' +
            active +
            '"></li>';

        $(".carousel .carousel-inner").append(image);
        if (data.length > 1)
            $(".carousel .carousel-indicators").append(indicator);

        active = "";
    });
}

function generate_row(data) {
    return [
        ["Tempat", data.nama_tempat ? data.nama_tempat : "-"],
        ["Deskripsi", data.deskripsi ? data.deskripsi : "-"],
        [
            "Riwayat Kepemilikan",
            data.riwayat_kepemilikan ? data.riwayat_kepemilikan : "-",
        ],
        ["Latar Sejarah", data.latar_sejarah ? data.latar_sejarah : "-"],
    ];
}

function generate_table(data) {
    var row = generate_row(data);
    generate_tabs_content(data);
    generate_carousel(data.galleries);

    $("#popup-table").html("");
    var myTableDiv = document.getElementById("popup-table");

    var table = document.createElement("TABLE");

    var tableBody = document.createElement("TBODY");
    table.appendChild(tableBody);

    row.forEach((value) => {
        var tr = document.createElement("TR");
        tableBody.appendChild(tr);

        var td = document.createElement("TD");
        td.appendChild(document.createTextNode(value[0]));
        tr.appendChild(td);

        var td = document.createElement("TD");
        td.appendChild(document.createTextNode(":"));
        tr.appendChild(td);

        var td = document.createElement("TD");
        td.appendChild(document.createTextNode(value[1]));
        tr.appendChild(td);
    });
    myTableDiv.appendChild(table);
}

function popup_content(data) {
    $("#popup-pics").html("");
    var pics = document.getElementById("popup-pics");

    generate_table(data);

    $("#popup_format .title").text(data.nama_objek);
    $("#popup_format .location").text(
        data.desa.title + " - Kec. " + data.desa.kecamatan.title
    );

    //   var img;
    //   data.pics.reverse().slice(0, 1).forEach(value => {
    //     img = document.createElement('IMG');
    //     img.setAttribute("src", {{ Storage::url('') }} + "assets/images/thumbnail_" + value.gambar.split("/")
    //       .pop());
    //     pics.appendChild(img);
    //   })

    return $("#popup_format").html();
}
