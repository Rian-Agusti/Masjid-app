<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class KeuanganController extends Controller
{
    /**
     * Menampilkan daftar transaksi.
     */
    public function index(Request $request)
    {
        // Ambil input search, default string kosong
        $search = $request->input('search', '');

        $transactions = Keuangan::latest()
            ->when($search, function ($query) use ($search) {
                // Gunakan variabel $search agar tipe jelas string
                $query->where('category', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('admin.keuangan.index', compact('transactions'));
    }

    /**
     * Form tambah transaksi baru.
     */
    public function create()
    {
        return view('admin.keuangan.create');
    }

    /**
     * Simpan transaksi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'        => 'required|in:income,expense',
            'category'    => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        Keuangan::create($validated);

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu transaksi.
     */
    public function show(Keuangan $keuangan)
    {
        return view('admin.keuangan.show', compact('keuangan'));
    }

    /**
     * Form edit transaksi.
     */
    public function edit(Keuangan $keuangan)
    {
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    /**
     * Perbarui data transaksi.
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $validated = $request->validate([
            'type'        => 'required|in:income,expense',
            'category'    => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        $keuangan->update($validated);

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }


    /**
     * Hapus transaksi.
     */
    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function laporan()
    {
        $transactions = Keuangan::latest()->paginate(10);
        $totalIncome = Keuangan::where('type', 'income')->sum('amount');
        $totalExpense = Keuangan::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

    return view('users.keuangan.laporan', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function exportPdf()
    {
        $transactions = Keuangan::latest()->get();
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $pdf = Pdf::loadView('admin.keuangan.pdf', compact('transactions', 'totalIncome', 'totalExpense', 'balance'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-keuangan-'.now()->format('Y-m-d').'.pdf');
    }
}
