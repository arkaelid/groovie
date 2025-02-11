@extends('admin.layoutadmin')

@section('title', 'Groovie - Dashboard')

@section('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        .btn-view {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background-color:rgb(31, 163, 42); /* Bleu foncé */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
            width: 100px;
            cursor: pointer; 
        }
        .btn-view-two {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background-color:rgb(189, 47, 39); /* Bleu foncé */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
            width: 100px;
            cursor: pointer; 
        }
        .btn-view-three {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background-color:rgb(218, 170, 15); /* Bleu foncé */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
            width: 100px;
            cursor: pointer; 
        }
        .btn-view-four {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background-color: #000b58; /* Bleu foncé */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
        }
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #000b58;
        }

        .card p {
            font-size: 16px;
            color: #555;
        }

        .card .icon {
            font-size: 40px;
            color: #000b58;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div>
            <h3 style="margin-bottom: 15px; color: #000b58; display: inline-block;">Ensemble des groovers</h3>
            
            <!-- Message de session -->
            @if (session('msg'))
                <h4 class="msg" style="display: inline-block; margin-left: 20px; padding: 5px 10px; border-radius: 5px; 
                    @if(session('msg') == 'Utilisateur supprimé.') background-color: #f44336; color: white;
                    @elseif(session('msg') == 'Utilisateur disponible.') background-color: #4CAF50; color: white;
                    @else background-color: #FFEB3B; color: black; @endif">
                    {{ session('msg') }}
                </h4>
            @endif
            
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Nom Prénom</th>
                        <th>Pseudo</th>
                        <th>Id Groover</th>
                        <th>État</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                        <td>{{$user->pseudo}}</td> 
                        <td>{{$user->id_groover}}</td>
                        <td>{{$user->etat}}</td>
                        <td>
                            @if ($user->etat == "supprime")
                                <form action="{{ route('admin.user.disponible', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-view">Réactiver</button>
                                </form>

                                <form action="{{ route('admin.user.suspendre', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-view-three">Suspendre</button>
                                </form>
                            @elseif ($user->etat == "suspendu")
                                <form action="{{ route('admin.user.disponible', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-view">Réactiver</button>
                                </form>

                                <form action="{{ route('admin.user.delete', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-view-two">Supprimer</button>
                                </form>
                            @else
                                <form action="{{ route('admin.user.suspendre', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-view-three">Suspendre</button>
                                </form>

                                <form action="{{ route('admin.user.delete', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-view-two">Supprimer</button>
                                </form>
                            @endif
                            <a href="{{Route('admin.user.profil', $user) }}" class="btn btn-view-four" style="margin-left: auto;">
                                Consulter
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('js')
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 7,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>
@endsection