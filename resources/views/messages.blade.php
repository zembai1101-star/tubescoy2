@extends('dashboard') {{-- Mengikuti induk layout admin kamu (misal: dashboard atau main) --}}

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-envelope mr-2"></i> Pesan Kontak Masuk</h3>
                    </div>

                    <div class="card-body p-0">
                        @if(session('success'))
                            <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%">Pengirim</th>
                                    <th style="width: 20%">Subjek</th>
                                    <th style="width: 40%">Isi Pesan</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <strong>{{ $item->name }}</strong><br>
                                            <small class="text-muted">{{ $item->email }}</small>
                                        </td>
                                        <td><span class="badge badge-info"
                                                style="background-color: #17a2b8;">{{ $item->subject }}</span></td>
                                        <td>{{ $item->message }}</td>
                                        <td>
                                            <form action="{{ route('admin.contacts.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-envelope-open fa-3x mb-3 text-secondary"></i><br>
                                            Belum ada pesan kontak yang masuk dari pengunjung.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection