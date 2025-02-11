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
            <h3 style="margin-bottom: 15px; color: #000b58; display: inline-block;">Ensemble des festivals</h3>
            <h4 style="margin-bottom: 15px; color:rgb(7, 88, 0); display: inline-block;">            
                @if(session('msg'))
                    {{ session('msg') }}                
                @endif
            </h4>


            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Nom du festival</th>
                        <th>Lieu</th>
                        <th>Type de musique</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($festivals as $festival)
                    <tr>
                        <td>{{$festival->nom_festival}}</td>
                        <td>{{$festival->lieu_festival}}</td>
                        <td>{{$festival->type}}</td>
                        <td>
                            <a href="{{Route('admin.festival.show', $festival)}}" class="btn btn-view-four" style="margin-left: auto;">
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