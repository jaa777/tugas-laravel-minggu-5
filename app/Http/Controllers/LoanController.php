<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        return response()->json(Loan::with(['member', 'book'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
        ]);

        $loan = DB::transaction(function () use ($data) {
            $book = Book::lockForUpdate()->findOrFail($data['book_id']);

            if ($book->stock < 1) {
                abort(422, 'Stok buku habis.');
            }

            $book->decrement('stock');

            return Loan::create($data + ['status' => 'borrowed']);
        });

        return response()->json($loan->load(['member', 'book']), 201);
    }

    public function show($id)
    {
        $loan = Loan::with(['member', 'book'])->findOrFail($id);

        return response()->json($loan, 200);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $data = $request->validate([
            'loan_date' => 'sometimes|required|date',
            'due_date' => 'sometimes|required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
        ]);

        DB::transaction(function () use ($loan, $data) {
            // Jika buku baru dikembalikan: ubah status dan kembalikan stok.
            if (! empty($data['return_date']) && $loan->status === 'borrowed') {
                $data['status'] = 'returned';
                $loan->book()->increment('stock');
            }

            $loan->update($data);
        });

        return response()->json($loan->fresh(['member', 'book']), 200);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);

        if ($loan) {
            DB::transaction(function () use ($loan) {
                // Jika masih dipinjam lalu dihapus, stok dikembalikan.
                if ($loan->status === 'borrowed') {
                    $loan->book()->increment('stock');
                }
                $loan->delete();
            });
        }

        return response()->json(null, 204);
    }
}