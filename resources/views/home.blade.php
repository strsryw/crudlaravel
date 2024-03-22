@extends('layouts.main')
@section('container')
    <div class="card">
        <div class="card-body">
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search nama mahasiswa" id="filterNama">
                    <button class="btn btn-outline-primary" type="button" onclick="getData()">Search</button>
                </div>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-primary mb-4" id="addBtn" onclick="addData()">ADD DATA</button>
            </div>
            <div class="table-responsive">
                <div class="alert alert-dismissible fade show" role="alert" id="alertDialog" style="display: none">
                    <div id="alertMessage"><strong>Holy Molly</strong> You should check in on some of those fields
                        below.
                    </div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Data akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script src="/js/script.js"></script>
    @endpush










    <div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD DATA MAHASISWA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="tampungId">
                    <div class="mb-3">
                        <label for="nimMhs" class="col-form-label">Nim </label>
                        <input type="text" class="form-control" id="nimMhs" name="nimMhs">
                    </div>
                    <div class="mb-3">
                        <label for="namaMhs" class="col-form-label">Nama </label>
                        <input type="text" class="form-control" id="namaMhs" name="namaMhs">
                    </div>
                    <div class="mb-3">
                        <label for="emailMhs" class="col-form-label">Email </label>
                        <input type="text" class="form-control" id="emailMhs" name="emailMhs">
                    </div>
                    <div class="mb-3">
                        <label for="jurusanMhs" class="col-form-label">Jurusan </label>
                        <input type="text" class="form-control" id="jurusanMhs" name="jurusanMhs">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveBtn" style="display: block"
                        onclick="insertData()">SAVE</button>
                    <button type="button" class="btn btn-primary" id="updateBtn" onclick="updateData()"
                        style="display: none">SAVE</button>
                </div>
            </div>
        </div>
    </div>
@endsection
