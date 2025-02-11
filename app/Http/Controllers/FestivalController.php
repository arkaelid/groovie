<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\{
    Festival,
    Actualite,
    Billet,
    User,
};
use Auth;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {  
        $festivals_proximite = Festival::all()->take(4);
            $festivals_nouveautes = Festival::orderBy('created_at', 'desc')->take(4)->get();
            $festivals_avenir = Festival::orderBy('date_heure_debut', 'asc')->take(4)->get();
            $actualites = Actualite::all();
            $festivals = [
                'À proximité' => $festivals_proximite,
                'Nouveautés' => $festivals_nouveautes,
                'Populaires' => $festivals_avenir,
            ];

            $filterName = Null;
            return view('home', compact('festivals', 'actualites', 'filterName'));

     }
     
     
    

    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Festival $festival)
    {
        $token = env('oAuth');
        $response = Http::withToken($token)
        ->get('https://www.eventbriteapi.com/v3/events/'.$festival->id_api); 

        if ($response->successful()) {
            // Extraire les données importantes de la réponse JSON
            $eventData = $response->json();
            
            $eventUrl = $eventData['url'];

            // Mettre à jour le lien de l'événement dans la base de données
            $festival->update([
                'lien'=> $eventUrl,
            ]);
            // Passer les données à la vue
            $data = [
                'festival' => $festival, 
                'eventData' => $eventData, 
            ];
            
            return view('festival.show', $data);
        }else {
            $data = [
                'festival' => $festival, 
            ];
            return view('festival.show', $data);
        }

    }

    public function search(Request $request)
    {
        $query = $request->query('query'); // Récupérer la requête
    
        // Recherche des festivals par le nom
        $festivals = Festival::where('nom_festival', 'like', '%' . $query . '%')
                             ->get();
    
        // Retourner une réponse JSON avec les résultats rendus dans une vue partielle
        return response()->json([
            'html' => view('layouts.partials.festival_card', compact('festivals'))->render(),
        ]);
    }


    public function filter(Request $request)
    {
        $filter = $request->query('filter'); // Récupérer le filtre
        
        // Base de la requête
        $festivals = Festival::query();


        
        // Appliquer les filtres
        if ($filter === 'nouveautes') {
            $festivals->orderBy('created_at', 'desc'); // Trier par date de création
            $filterName = 'Nouveautés';
            // Récupérer les festivals (limité à 4)
            $festivals = $festivals->take(8)->get();
            // echo $filterName;
            // exit;
        } elseif ($filter === 'populaires') {
            // Trier par le nombre de billets
            $festivals->withCount('billets') // Compter le nombre de billets associés à chaque festival
                      ->orderBy('billets_count', 'desc'); // Trier par le nombre de billets
            // Récupérer les festivals (limité à 4)
            $festivals = $festivals->take(4)->get();
            $filterName = 'Populaires';
        } elseif ($filter === 'Tout') {
            $festivals->orderBy('id', 'desc');
            $filterName = 'Tous les festivals';
            // Récupérer les festivals (limité à 4)
            $festivals = $festivals->get();
        }
        // Si c'est une requête AJAX, renvoyer la vue partielle uniquement
        if ($request->ajax()) {
            return response()->json([
                'filterName' => $filterName,
                'festivals' => $festivals,
                'html' => view('layouts.partials.festival_card', compact('festivals'))->render(),
            ]);

        } 

        // Sinon, renvoyer la vue complète avec les festivals et le nom du filtre
        $actualites = Actualite::all();
        return view('home', compact('actualites', 'festivals', 'filterName'));

    
    }    
    
    public function addBillet(Festival $festival)
    {
        // Validation des données
        request()->validate([
            'code' => 'required',
            'email' => 'required'
        ]);
        
        // Récupération du billet
        $billet = Billet::where('code', request('code'))->first();
        $user = Auth::user();
        // Vérification si le billet existe
        if (!$billet) {
            $msg = "Billet non existant.";
            return back()->with('errorBillet', $msg);
        }
 

        // Vérification de l'authentification
        if (Auth::check()) {
            $user = Auth::user(); // Récupération de l'utilisateur connecté
            $id_festival = $billet->id_festival;
            // Vérification si l'utilisateur est déjà lié au festival
            if ($festival->id === $id_festival && !$user->festivals()->where('id_festival', $id_festival)->exists()) {
                // Ajout de l'utilisateur au festival via la table pivot
                $user->festivals()->attach($id_festival);
                return back()->with('successbillet', 'Billet validé, vous avez accès au festival.');

            }elseif($festival->id !== $id_festival){
                return back()->with('errorBillet', 'Billet est relié au festival ' . $billet->festival->nom_festival. '.');
            }
                return back()->with('successbillet', 'Votre billet est déjà validé, vous avez accès au festival.');

            

        }elseif(!Auth::check()) {
            $user = User::where('email', request('email'))->first();
            session(['user' => $user]);
            $id_festival = $billet->id_festival;
            if(!$user){
                return back()->with('errorBillet', 'Vous ne possédez pas de compte. Veuillez vous inscrire pour valider votre billet.');
            }elseif($festival->id !== $id_festival){
                return back()->with('errorBillet', 'Billet est relié au festival ' . $billet->festival->nom_festival. '.');
            }else{
                session(['billet' => $billet]);
                return back()->with('successbillet', 'Billet enregistré, veuillez vous authentifier pour valider l\'enregistrement.');
            }
        }
    
        return back()->withErrors(['auth' => 'Vous devez être connecté pour valider un billet.']);
    }
    

    public function addBilletWithoutFestival()
    {
        // Validation des données
        request()->validate([
            'code' => 'required',
            'email' => 'required'
        ]);
        
        // Récupération du billet
        $billet = Billet::where('code', request('code'))->first();
        $user = Auth::user();
        // Vérification si le billet existe
        if (!$billet) {
            $msg = "Billet non existant.";
            return back()->with('errorBillet', $msg);
        }
 

        // Vérification de l'authentification
        if (Auth::check()) {
            $user = Auth::user(); // Récupération de l'utilisateur connecté
            $id_festival = $billet->id_festival;
            // Vérification si l'utilisateur est déjà lié au festival
            if (!$user->festivals()->where('id_festival', $id_festival)->exists()) {
                // Ajout de l'utilisateur au festival via la table pivot
                $user->festivals()->attach($id_festival);
                return back()->with('successbillet', 'Billet validé, vous avez accès au festival.');

            }
            return back()->with('successbillet', 'Votre billet est déjà validé, vous avez accès au festival.');

            

        }elseif(!Auth::check()) {
            $user = User::where('email', request('email'))->first();
            session(['user' => $user]);
            if(!$user){
                return back()->with('errorBillet', 'Vous ne possédez pas de compte. Veuillez vous inscrire pour valider votre billet.');
            }else{
                session(['billet' => $billet]);
                return back()->with('successbillet', 'Billet enregistré, veuillez vous authentifier pour valider l\'enregistrement.');
            }
        }
    
        return back()->withErrors(['auth' => 'Vous devez être connecté pour valider un billet.']);
    }
}
