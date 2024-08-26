<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    //
    public function createIndex()
    {
        if (Auth::check())
        {
            return view('productCreate');
        }
        return redirect('login')->with('error','you are not allowed to access');
    }
    public function productFooter()
    {
        // Diese Methode zeigt eine Liste aller Produkte im Fußbereich der Website an ,, damit ohne anmelden  nur die produkte schauen kann
        $products =Product::all();
        return view('productFooter' ,compact('products'));
        // Hole alle Produkte aus der Datenbank und sende sie an die View 'productFooter'.
    }
    public function index()
    {
        // Diese Methode zeigt eine Liste aller Produkte an.
        $products = Product::all();
        return view('products',compact('products'));
        // Hole alle Produkte aus der Datenbank und sende sie an die View 'products'.
    }
    public function showProduct($id)
    {
        // Diese Methode zeigt die Details eines einzelnen Produkts an.
        $product = Product::find($id);    //diese $product muss gleiche name ( $product ->product_name oder $product->photo) in product blade sein
        return view('productDetail',compact('product'));
        // Finde das Produkt in der Datenbank anhand der übergebenen ID und sende es an die View 'productDetail'.
    }
    public function cart()
    {
        // Diese Methode zeigt den Warenkorb des Benutzers an.
        return view('cart');
    }
    public function deleteProduct($id)
    {
        // Diese Methode löscht ein Produkt aus der Datenbank.
        $product = Product::find($id);
        if (!$product){
            return redirect()->back()->with('error','Product not found!');
        }
        if (Auth::user()->usertype != 1 ){
            return redirect()->back()->with('error','You dont have permission to delete this product!');
            // Wenn der Benutzer nicht die Berechtigung zum Löschen hat, zeige eine Fehlermeldung und leite zurück.
        }
        $product ->delete();
        return redirect()->back()->with('success','Product was successfully deleted!');
        // Lösche das Produkt aus der Datenbank und zeige eine Erfolgsmeldung an.
    }
    public function store(Request $request)
    {
        // Diese Methode speichert ein neues Produkt in der Datenbank
        $products = new Product();
        $products->product_name = $request->product_name;
        $products->price = $request->price;
        $products->product_description = $request->product_description;
        $products->photo = $request->file('photo')->store('images','public');
        $products->save();

        return redirect()->route('productsCreate');
        // Speichere die vom Benutzer(Admin) eingegebenen Daten in der Datenbank und leite zur ProductCreate weiter.
    }
    public function addToCart($id)
    {
        // Diese Methode fügt ein Produkt mit der übergebenen ID zum Warenkorb hinzu
        //Hier wird versucht, das Produkt mit der angegebenen ID aus der Datenbank abzurufen
        $product = Product::findOrFail($id);

        // Hier wird der aktuelle Warenkorb aus der Session geladen. Wenn der Warenkorb in der Session nicht existiert,
        // wird ein leeres Array als Standardwert verwendet.
        $cart = session()->get('cart',[]);
        //Dieser Abschnitt prüft, ob das Produkt bereits im Warenkorb vorhanden ist.
        // Wenn ja, wird die Anzahl (quantity) des Produkts im Warenkorb um 1 erhöht.
        if (isset($cart[$id])){
            $cart[$id]['quantity']++;
        } else{
            //wird das Produkt dem Warenkorb hinzugefügt. Dabei werden der Produktname, das Foto,
            // der Preis und die Anfangsanzahl auf 1 gesetzt.
            $cart[$id]=[
              'product_name'=>$product->product_name,
                'photo'=>$product->photo,
                'price'=>$product->price,
                'quantity'=>1
            ];
        }
        session()->put('cart',$cart);   //Der aktualisierte Warenkorb wird in der Session gespeichert.
        return redirect()->back()->with('success','Product add to cart successfully');
    }

    public function update(Request $request, $id)
    {
        $newQuantity = $request->input('quantity');

        if ($newQuantity <= 0) {
            // Wenn die neue Menge 0 oder negativ ist, entfernen Sie das Produkt aus dem Warenkorb.
            $this->removeFromCart($id);
        } else {
            // Andernfalls aktualisieren Sie die Menge im Warenkorb.
            $cart = session('cart');
            $cart[$id]['quantity'] = $newQuantity;
            session(['cart' => $cart]);
        }

        return redirect()->route('cart')->with('success', 'Warenkorb aktualisiert');
    }
    public function remove(Request $request)
    {
        // Diese Methode entfernt ein Produkt aus dem Warenkorb.
        if ($request->id){
            $cart =session()->get('cart');
            if (isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart',$cart);
            }
            session()->flash('success','Product successfully removed!');
        }
        return redirect()->back();
    }
}
