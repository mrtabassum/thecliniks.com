<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionDataTable;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends AppBaseController
{
    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->TransactionRepository = $transactionRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new TransactionDataTable())->get())->make(true);
        }

        if (getLogInUser()->hasRole('patient')) {
            return view('transactions.index');
        }

        return view('transactions.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $transaction = $this->TransactionRepository->show($id);

        return view('transactions.show', compact('transaction'));
    }
}
