<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController extends Controller
{
    //
    public function show($id, Request $request)
    {
        $invoice = Invoice::find($id);
        $ordersList = $request->ordersList;
        return view('invoice',compact(['invoice','ordersList']));
        //die Rechnung haben wir bei js in cart blade gerechnet .
    }

    public function store(Request $request)
    {
        $cart = session('cart');

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Der Warenkorb ist leer.');
        }

        // Berechnen Sie die Gesamtsumme der Rechnung
        $total = 0;
        $invoiceProducts = [];

        foreach ($cart as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            $invoiceProducts[] = [
                'invoice_id' => null, // Wir setzen dies später
                'product_id' => $id,
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'total' => $subtotal,
                'subtotal' => $subtotal,
            ];
        }

        // Erstellen Sie die Rechnung und speichern Sie sie
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()->id;
        $invoice->total = $total;
        $invoice->save();

        // Aktualisieren Sie die invoice_id in den Rechnungspositionen und speichern Sie sie in der Tabelle invoice_products
        foreach ($invoiceProducts as &$invoiceProduct) {
            $invoiceProduct['invoice_id'] = $invoice->id;
        }

        // Massenweise Einfügen der Rechnungspositionen in die Tabelle invoice_products
        DB::table('invoice_products')->insert($invoiceProducts);

        // Löschen Sie den Warenkorb nach dem Erstellen der Rechnung
        session()->forget('cart');

        return redirect()->route('invoice.show', ["id" => $invoice->id])->with('success', 'Rechnung wurde erstellt.');
    }

    public function createPdf($id)
    {
        $invoice =Invoice::findOrFail($id);
        $htmlContent =view ('invoice_pdf',compact('invoice'))->render();

        // Konfigurieren Sie die Dompdf-Optionen
        $options = new Options();
        $options->set('isHtml5ParserEnabled',true);
        $options->set('isPhpEnabled',true);

        // Erstellen Sie das Dompdf-Objekt
        $domPdf =new Dompdf($options);

        // Laden Sie den HTML-Inhalt in Dompdf
        $domPdf->loadHtml($htmlContent);

        // Rendern Sie das HTML in ein PDF
        $domPdf->render();

        // Geben Sie das PDF an den Browser aus
        return $domPdf->stream('rechnung.pdf');
    }
    public function history()
    {
        $invoices = Invoice::query()
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('orders.my-orders', compact('invoices'));
    }

}
