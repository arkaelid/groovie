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
    <div class="dashboard-cards">
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <div class="icon" style="margin-right: 15px;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <a href="{{Route('admin.users')}}" class="btn btn-view" style="margin-left: auto;">
                    Consulter
                </a>
            </div>
            <h3>Total Utilisateurs</h3>
            <p>{{ $totalUsers ?? 0 }} Utilisateurs</p>
        </div>

        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <div class="icon" style="margin-right: 15px;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <a href="{{Route ('admin.festivals') }}" class="btn btn-view" style="margin-left: auto;">
                    Consulter
                </a>
            </div>
            <h3>Festivals</h3>
            <p>{{ $totalFestivals ?? 0 }} Festivals organisés</p>
        </div>
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <div class="icon" style="margin-right: 15px;">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                <a href="{{Route ('admin.show.offres')}}" class="btn btn-view" style="margin-left: auto;">
                    Consulter
                </a>
            </div>
            <h3>Offres</h3>
            <p>{{ $totalOffres ?? 0 }} Offres disponibles</p>
        </div>
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <div class="icon" style="margin-right: 15px;">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>
            </div>
            <h3>Partenaires</h3>
            <p>{{ $totalPartenaires ?? '0 ' }} Partenaires associés</p>
        </div>
    </div>
    <div class="dashboard-cards">
        <div class="card">
            <h3 style="margin-bottom: 15px; color: #000b58;">Transactions Groovie</h3>
            <div>
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Offres</th>
                            <th>Clients</th>
                            <th>Points groovie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($offres_users as $offre)
                        @foreach($offre->users as $user)
                            <tr>
                                <td>{{ $offre->nom_offre }}</td>
                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                <td>{{ $offre->points_groovie }}</td> <!-- Supposons qu'il y ait une colonne `points` dans la table pivot -->
                                <td>
                                <a href="{{Route('admin.user.profil', $user) }}" class="btn btn-view">
                                    Voir
                                </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
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
            pageLength: 5,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>
@endsection