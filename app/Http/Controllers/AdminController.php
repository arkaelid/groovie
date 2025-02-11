<?php

namespace App\Http\Controllers;

use App\Models\{
    Actualite,
    User,
    Festival,
    Offre,
    Partenaire,
    Trajet,
    Notification
};
use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Vous êtes connecté');
            } else {
                Auth::logout();
                return back()->with('error', 'Vous devez être un administrateur pour vous connecter.');
            }
        }

        return back()->with('error', 'Identifiants incorrects')->withInput();
    }

    public function dashboard(){
        $totalUsers = User::where('role', 'user')->count();
        $totalFestivals = Festival::count();
        $totalPartenaires = Partenaire::count();
        $totalOffres = Offre::count();
        $offres = Offre::whereHas('users')->with('users')->get();
        $data =[
            'offres_users'=> $offres,
            'totalFestivals'=>$totalFestivals,
            'totalUsers'=>$totalUsers,
            'totalPartenaires'=>$totalPartenaires,
            'totalOffres' => $totalOffres
        ];
        return view('admin.dashboard', $data);
    }

    public function usersCatalog(){
        $users = User::where('role', 'user')->get();
        $data  = [
            'users'=>$users
        ];
        return view('admin.user', $data);
    }

    public function userDelete(User $user){
        $user->update(['etat' => 'supprime']);

        return redirect()->route('admin.users')->with('msg', 'Utilisateur supprimé.');
    }
    public function userSuspendre(User $user){
        $user->update(['etat' => 'suspendu']);

        return redirect()->route('admin.users')->with('msg', 'Utilisateur suspendu.');
    }
    public function userDisponible(User $user){
        $user->update(['etat' => 'disponible']);

        return redirect()->route('admin.users')->with('msg', 'Utilisateur disponible.');
    }
    
    public function userProfil(User $user){
        $user_offres = $user->offres;
        $data = [
            'user' =>$user,
            'user_offres'=>$user_offres,
        ];    
        return view('admin.user_details', $data);    
    }

    public function updateProfil(User $user, Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'pseudo' => 'required|string|max:255|unique:users,pseudo,' . $user->id,
        ]);
        
        $user->update($request->only(['firstname', 'lastname', 'email', 'pseudo']));
        return redirect()->back()->with('msg', 'Profil mis à jour avec succès.');
    }

    public function showOffres(){
        $offres = Offre::all();
        $data = [
            'offres'=> $offres,
        ];
        return view('admin.offres', $data);
    }

    public function fetivalCatalog(){
        $festivals = Festival::all();

        $data = [
            'festivals' => $festivals,
        ];

        return view('admin.events', $data);
    }

    public function showFestival(Festival $festival){
        $trajets = $festival->trajets;
        $data =[
            'festival' => $festival,
            'trajets' => $trajets,
        ];
        return view('admin.event', $data);
    }


    public function editFestival(Festival $festival, Request $request)
    {
        // Validation des données
        $request->validate([
            'nom_festival' => 'required|string|max:255',
            'prix' => 'required|numeric', // Ajout d'une validation numérique pour 'prix'
            'lieu_festival' => 'required|string|max:255',
            'date_heure_debut' => 'required|date|before:date_heure_fin',
            'date_heure_fin' => 'required|date|after:date_heure_debut',
        ]);
        // Mise à jour des données
        $festival->update($request->only(['nom_festival', 'prix', 'lieu_festival', 'date_heure_debut', 'date_heure_fin']));

        $usersFestival = $festival->utilisateurs;
        $user = Auth::user(); 
        $notification = Notification::create([
            'id_festival' => $festival->id,
            'id_utilisateur' => $user->id,
            'type' => 'modification',
            'description' => 'Le festival ' . $festival->nom_festival . ' a été modifié.',
            'created_at'=> now(),
            // Ajoute d'autres champs si nécessaire, par exemple 'lue' => false, etc.
        ]);

        foreach ($usersFestival as $userfestival) {
            $notification->utilisateurs()->attach($userfestival->id);
        }
        // Redirection avec message de succès
        return redirect()->back()->with('msg', 'Festival mis à jour avec succès.');
    }
    
    public function deleteFestival(Festival $festival){
        $usersFestival = $festival->utilisateurs;
        $user = Auth::user(); 
        $notification = Notification::create([
            'id_festival' => $festival->id,
            'id_utilisateur' => $user->id,
            'type' => 'suppression',
            'description' => 'Le festival ' . $festival->nom_festival . ' n\'est plus disponible.',
            'created_at'=> now(),
            // Ajoute d'autres champs si nécessaire, par exemple 'lue' => false, etc.
        ]);
        foreach ($usersFestival as $userfestival) {
            $notification->utilisateurs()->attach($userfestival->id);
        }
        $festival->delete();
        return redirect()->route('admin.festivals')->with('msg', 'Festival supprimé avec succès.');
    }

    public function actualiteCatalog(){
        $actualites = Actualite::all();
        $data = [
            'actualites' =>$actualites,
        ];
        return view('admin.actu', $data);
    }

    public function actualiteShow(Actualite $actualite){
        $actualiteFestival = $actualite->festivals;
        $data = [
            'actualite' =>$actualite,
            'actualiteFestival' => $actualiteFestival,
        ];
        return view('admin.actu_show', $data);
    }

    public function actualiteUpdate(Actualite $actualite, Request $request){

        $request->validate([
            'nom'=>'required|string|max:255',
            'type'=>'required|string|max:128',
            'descriptif'=>'required|string',
        ]);

        $actualite->update($request->only(['nom', 'type', 'descriptif']));
        $user = Auth::user(); 

        foreach ($actualite->festivals as $festival){
            $notification = Notification::create([
                'id_festival' => $festival->id,
                'id_utilisateur' => $user->id,
                'type' => 'modification',
                'description' => 'L\'actualité du festival ' . $festival->nom_festival . ' a été mise à jour.',
                'created_at'=> now(),
            ]);
            foreach ($festival->utilisateurs as $festivalusers){
                $notification->utilisateurs()->attach($festivalusers->id);
            }
        }
        return redirect()->back()->with('msg', 'Actualité mise à jour avec succès.');

    }

    public function actualiteDelete(Actualite $actualite){
        $user = Auth::user();

        // Récupérer les festivals associés à l'actualité
        $festivalsActualite = $actualite->festivals;
    
        // Supprimer l'actualité (avant de supprimer les notifications)
        $actualite->delete();
    
        // Supprimer les notifications liées à ces festivals
        foreach ($festivalsActualite as $festival) {
            // Supprimer les notifications associées au festival
            Notification::where('id_festival', $festival->id)->delete();
        }
        // Rediriger un message de succès
        return redirect()->route('admin.actualites')->with('msg', 'Actualité et notifications supprimées avec succès.');
    }

    public function actualiteAjout(){
        $festivals = Festival::all();
        $data = [
            'festivals'=>$festivals
        ];
        return view ('admin.actu_create', $data);
    }

    public function actualiteCreate(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'descriptif' => 'required|string|max:500',
            'festival_ids' => 'required|array', // Assure-toi qu'il y a bien un tableau d'IDs de festivals
            'festival_ids.*' => 'exists:festivals,id', // Assure que chaque festival existe
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('actualites', 'public');
        } else {
            return redirect()->back()->withError(['image' => 'Le fichier image est requis.']);
        }

        $actualite = Actualite::create([
            'type' => $request->input('type'),
            'nom' => $request->input('nom'),
            'descriptif' => $request->input('descriptif'),
            'image' => $imagePath,
        ]);
        $user = Auth::user();
        $actualite->festivals()->attach($request->input('festival_ids'));

        $festivals = Festival::whereIn('id', $request->input('festival_ids'))->get();
        foreach ($festivals as $festival) {
            $notification = Notification::create([
                'id_festival' => $festival->id,
                'id_utilisateur' => $user->id,
                'type' => 'Nouveauté',
                'description' => 'Une actualité au festival ' . $festival->nom_festival . ' a été ajoutée.',
                'created_at'=> now(),
            ]);
            foreach ($festival->utilisateurs as $festivalusers){
                $notification->utilisateurs()->attach($festivalusers->id);
            }
        }

        return redirect()->route('admin.actualites')->with('msg', 'Actualité créée et associée avec succès aux festivals');
    }  

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('admin.login');
    }
}
