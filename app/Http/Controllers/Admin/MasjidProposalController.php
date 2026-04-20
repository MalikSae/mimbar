<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasjidProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasjidProposalController extends Controller
{
    public function index()
    {
        $proposals = MasjidProposal::orderByDesc('created_at')
            ->when(request('status'), fn($q) =>
                $q->where('status', request('status')))
            ->when(request('provinsi'), fn($q) =>
                $q->where('provinsi', 'like', '%' . request('provinsi') . '%'))
            ->paginate(20);

        $stats = [
            'pending'   => MasjidProposal::where('status', 'pending')->count(),
            'diproses'  => MasjidProposal::where('status', 'diproses')->count(),
            'disetujui' => MasjidProposal::where('status', 'disetujui')->count(),
            'ditolak'   => MasjidProposal::where('status', 'ditolak')->count(),
        ];

        return view('admin.masjid-proposal.index', compact('proposals', 'stats'));
    }

    public function show($id)
    {
        $proposal = MasjidProposal::with('files')->findOrFail($id);
        return view('admin.masjid-proposal.show', compact('proposal'));
    }

    public function update(Request $request, $id)
    {
        $proposal = MasjidProposal::findOrFail($id);
        $request->validate([
            'status'        => 'required|in:pending,diproses,disetujui,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);
        $proposal->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);
        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $proposal = MasjidProposal::with('files')->findOrFail($id);
        foreach ($proposal->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }
        $proposal->delete();
        return redirect()->route('admin.masjid.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function export()
    {
        $proposals = MasjidProposal::orderByDesc('created_at')->get();
        $filename = 'pengajuan-masjid-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $callback = function () use ($proposals) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'ID', 'Nama Pemohon', 'No. Telp', 'Email',
                'Provinsi', 'Kabupaten', 'Kecamatan',
                'Status Tanah', 'Luas Tanah',
                'Imam', 'Status', 'Tanggal'
            ]);
            foreach ($proposals as $p) {
                fputcsv($file, [
                    $p->id,
                    $p->nama_organisasi_pemohon,
                    $p->no_telp_pemohon,
                    $p->email_pemohon,
                    $p->provinsi,
                    $p->kabupaten,
                    $p->kecamatan,
                    $p->status_tanah,
                    $p->luas_tanah,
                    $p->imam_nama,
                    $p->status,
                    $p->created_at->format('d/m/Y H:i'),
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf($id)
    {
        $proposal = MasjidProposal::with('files')->findOrFail($id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.masjid-proposal.pdf', compact('proposal'));
        
        return $pdf->download('Proposal_Masjid_' . str_replace(' ', '_', $proposal->nama_organisasi_pemohon) . '_' . date('Ymd') . '.pdf');
    }
}
