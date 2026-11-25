<tbody id="daftarRiwayat">
    @foreach ($pengaduans as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
            <td>
                <strong>{{ $item->zona->nama_zona ?? '-' }}</strong><br>
                <small class="text-muted">{{ $item->lokasi }}</small>
            </td>
            <td><span class="badge bg-secondary">{{ ucfirst($item->jenis_sampah) }}</span></td>
            <td>
                @if ($item->foto_kondisi_awal)
                    <img src="{{ asset('storage/' . $item->foto_kondisi_awal) }}" alt="Foto Sampah"
                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                @else
                    <span class="text-muted">Tidak ada foto</span>
                @endif
            </td>
            <td class="text-center">
                @if ($item->status_laporan == 'selesai')
                    <span class="badge bg-success px-3 py-2">Selesai</span>
                @elseif($item->status_laporan == 'diproses')
                    <span class="badge bg-info text-dark px-3 py-2">Diproses</span>
                @else
                    <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                @endif
            </td>
            <td class="text-center">
                <button class="btn btn-sm btn-outline-primary">Detail</button>
            </td>
        </tr>
    @endforeach
</tbody>
