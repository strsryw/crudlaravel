$(document).ready(function () {
    getData();
});

function getData() {
    var filterNama = document.getElementById("filterNama").value;
    var csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    $.ajax({
        url: "/get-all-data",
        type: "post",
        data: {
            filterNama,
            _token: csrfToken,
        },
        success: function (result) {
            console.log(result.message);
            if (result.message == "Data Kosong") {
                $("#tableBody").html(
                    `<tr><td colspan=5 class='text-center'> Data Kosong </td></tr>`
                );
                return;
            }

            // console.log(result.links);
            // return;

            // var pagination = "";
            // result.links.forEach((link) => {
            //     if (link.active) {
            //         pagination += `<li class="page-item active"><a class="page-link" href="${link.url}">${link.label}</a></li>`;
            //     } else {
            //         pagination += `<li class="page-item"><a class="page-link" href="${link.url}">${link.label}</a></li>`;
            //     }
            // });

            // document.getElementById("linkHal").innerHTML = pagination;
            // return;
            // Menghapus isi tabel sebelumnya
            else {
                $("#tableBody").empty();
                // Membuat string HTML untuk semua baris
                var tableRows = "";
                for (var i = 0; i < result.data.length; i++) {
                    tableRows += `
                <tr>
                    <td id='txtNim${result.data[i].id}'>${result.data[i].nim}</td>
                    <td id='txtNama${result.data[i].id}'>${result.data[i].nama}</td>
                    <td id='txtEmail${result.data[i].id}'>${result.data[i].email}</td>
                    <td id='txtJurusan${result.data[i].id}'>${result.data[i].jurusan}</td>
                    <td class='text-center'>
                
                    <button type='button' class="btn btn-xs btn-danger" onclick="deleteData(${result.data[i].id})"><i class="ti ti-trash"></i></button>
                    <button type='button' class="btn btn-xs btn-warning" onclick="editData(${result.data[i].id})"><i class="ti ti-edit"></i></button>
                   
                    </td>
                </tr>`;
                }

                // Menambahkan semua baris ke dalam tabel
                $("#tableBody").html(tableRows);
            }
        },
    });
}

function addData() {
    document.getElementById(`nimMhs`).value = "";
    document.getElementById(`namaMhs`).value = "";
    document.getElementById(`emailMhs`).value = "";
    document.getElementById(`jurusanMhs`).value = "";
    $("#modalData").modal("show");
    $("#exampleModalLabel").text("ADD DATA MAHASISWA");
}

function insertData() {
    var modalNim = document.getElementById(`nimMhs`).value;
    var modalNama = document.getElementById(`namaMhs`).value;
    var modalEmail = document.getElementById(`emailMhs`).value;
    var modalJurusan = document.getElementById(`jurusanMhs`).value;
    var csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    $.ajax({
        url: "/insert",
        type: "POST",
        data: {
            _token: csrfToken, // Sertakan CSRF token di sini
            modalNim,
            modalNama,
            modalEmail,
            modalJurusan,
        },
        success: function (response) {
            console.log(response);
            $("#modalData").modal("hide");
            getData();
            var alertDialog = document.getElementById("alertDialog");
            alertDialog.style.display = "block";
            document.getElementById("alertMessage").innerHTML =
                response.message;
            document
                .getElementById("alertDialog")
                .classList.add("alert-danger");

            if (alertDialog.classList.contains("alert-danger")) {
                alertDialog.classList.remove("alert-danger");
                alertDialog.classList.add("alert-success");
            } else {
            }
        },
    });
}

function editData(id) {
    document.getElementById("tampungId").value = id;

    var txtNim = document.getElementById(`txtNim${id}`).innerText;
    var txtNama = document.getElementById(`txtNama${id}`).innerText;
    var txtEmail = document.getElementById(`txtEmail${id}`).innerText;
    var txtJurusan = document.getElementById(`txtJurusan${id}`).innerText;
    document.getElementById("nimMhs").value = txtNim;
    document.getElementById("namaMhs").value = txtNama;
    document.getElementById("emailMhs").value = txtEmail;
    document.getElementById("jurusanMhs").value = txtJurusan;

    $("#modalData").modal("show");
    document.getElementById("updateBtn").style.display = "block";
    document.getElementById("saveBtn").style.display = "none";
}

function updateData() {
    var nimMhs = document.getElementById("nimMhs").value;
    var namaMhs = document.getElementById("namaMhs").value;
    var emailMhs = document.getElementById("emailMhs").value;
    var jurusanMhs = document.getElementById("jurusanMhs").value;
    var id = document.getElementById("tampungId").value;
    var csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    $.ajax({
        url: "/update/" + id,
        type: "POST",
        data: {
            _token: csrfToken, // Sertakan CSRF token di sini
            nimMhs: nimMhs,
            namaMhs: namaMhs,
            emailMhs: emailMhs,
            jurusanMhs: jurusanMhs,
        },
        success: function (response) {
            console.log(response);
            $("#modalData").modal("hide");
            getData();
            var alertDialog = document.getElementById("alertDialog");
            alertDialog.style.display = "block";
            document.getElementById("alertMessage").innerHTML =
                response.message;
            document
                .getElementById("alertDialog")
                .classList.add("alert-danger");

            if (alertDialog.classList.contains("alert-danger")) {
                alertDialog.classList.remove("alert-danger");
                alertDialog.classList.add("alert-success");
            } else {
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
}

function deleteData(id) {
    var csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        $.ajax({
            url: "/delete/" + id,
            type: "POST",
            data: {
                _token: csrfToken, // Sertakan CSRF token di sini
                id: id,
            },
            success: function (response) {
                console.log(response);
                getData();

                var alertDialog = document.getElementById("alertDialog");

                alertDialog.style.display = "block";
                document.getElementById("alertMessage").innerHTML =
                    response.message;
                document
                    .getElementById("alertDialog")
                    .classList.add("alert-danger");

                if (alertDialog.classList.contains("alert-success")) {
                    alertDialog.classList.remove("alert-success");
                    alertDialog.classList.add("alert-danger");
                } else {
                }
            },
        });
    }
}

function pageNavMulti(curHal, maxHal, jmlTampil, fungsi) {
    let linkHal = "";
    let angka = "";
    const halTengah = Math.round(jmlTampil / 2);

    if (maxHal > 1) {
        if (curHal > 1) {
            const previous = curHal - 1;
            linkHal += `<ul class='pagination'><li class='page-item'><a class='page-link' onclick='${fungsi}(1)'>First</a></li>`;
            linkHal += `<li class='page-item'><a class='page-link' onclick='${fungsi}(${previous})'>Prev</a></li>`;
        } else if (!curHal || curHal === 1) {
            linkHal +=
                "<ul class='pagination'><li class='page-item'><a class='page-link'>First</a></li><li class='page-item'><a class='page-link'>Prev</a></li> ";
        }

        for (let i = curHal - (halTengah - 1); i < curHal; i++) {
            if (i < 1) continue;
            angka += `<li class='page-item'><a class='page-link' onclick='${fungsi}(${i})'>${i}</a></li>`;
        }

        angka += `<li class='page-item active'><span class='page-link'><b>${curHal}</b> <span class='sr-only'>(current)</span></span></li>`;

        for (let i = curHal + 1; i < curHal + halTengah; i++) {
            if (i > maxHal) break;
            angka += `<li class='page-item'><a class='page-link' onclick='${fungsi}(${i})'>${i}</a></li> `;
        }

        linkHal += angka;

        if (curHal < maxHal) {
            const next = curHal + 1;
            linkHal += `<li class='page-item'><a class='page-link'onclick='${fungsi}(${next})'>Next </a></li><li class='page-item'><a class='page-link' onclick='${fungsi}(${maxHal})'>Last</a></li> </ul>`;
        } else {
            linkHal +=
                "<li class='page-item'><a class='page-link'>Next</a></li><li class='page-item'><a class='page-link'>Last</a></li></ul>";
        }
    }

    return linkHal;
}
