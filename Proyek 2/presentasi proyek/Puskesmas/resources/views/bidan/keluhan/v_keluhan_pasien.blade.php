@extends("templating")

@section("content")

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">
            Data Pasien
        </h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="flaticon-home"></i> Dashboard
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i> Daftar Akun
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Pasien</th>
                                    <th class="text-center">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">

                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@section("js")

<script src="{{ url('') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script>

@endsection
