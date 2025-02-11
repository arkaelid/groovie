@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <!-- Carte profil -->
    <div class="card shadow-lg border-0 overflow-hidden animate__animated animate__fadeIn" style="width: 100%; max-width: 600px; border-radius: 20px;">
        <!-- En-tête de la carte -->
        <div class="card-header text-center text-white rounded-top" style="background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 20px 20px 0 0; padding: 2rem;">
            <h3 class="mb-0 fw-bold">Profile Details</h3>
        </div>

        <!-- Corps de la carte -->
        <div class="card-body text-dark p-5">
            <!-- Photo de profil -->
            <div class="d-flex flex-column align-items-center mb-4">
                <div class="profile-picture-container mb-3">
                    <img src="https://via.placeholder.com/150" alt="Photo de Profil"
                         class="img-fluid rounded-circle profile-picture">
                </div>
                <h4 class="fw-bold mb-1" id="nameDisplay">John Doe</h4>
                <p class="fst-italic mb-0 text-muted">Web Developer</p>
            </div>

            <!-- Informations détaillées -->
            <div class="row mt-4" id="infoSection">
                <div class="col-md-6">
                    <p class="mb-3"><strong>Age:</strong> <span class="text-primary" id="ageDisplay">30</span></p>
                    <p class="mb-3"><strong>Mobile:</strong> <span class="text-primary" id="mobileDisplay">+1 234 567 890</span></p>
                </div>
                <div class="col-md-6">
                    <p class="mb-3"><strong>Email:</strong> <span class="text-primary" id="emailDisplay">john@example.com</span></p>
                    <p class="mb-3"><strong>Address:</strong> <span class="text-primary" id="addressDisplay">123 Main St, Anytown, USA</span></p>
                </div>
            </div>

            <!-- Champ de saisie pour modification -->
            <div id="editFields" style="display: none;">
                <div class="form-group mb-3 position-relative">
                    <input type="text" id="nameInput" class="form-control" placeholder="Nom" value="John Doe">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2z"/>
                    </svg>
                </div>
                <div class="form-group mb-3 position-relative">
                    <input type="number" id="ageInput" class="form-control" placeholder="Age" value="30">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm1 11v1a1 1 0 0 1-2 0v-1a1 1 0 0 1 2 0zm-1-9a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0V7a1 1 0 0 1 1-1z"/>
                    </svg>
                </div>
                <div class="form-group mb-3 position-relative">
                    <input type="text" id="mobileInput" class="form-control" placeholder="Mobile" value="+1 234 567 890">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 2a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h12zm0 2H6v16h12V4zm-6 3a1 1 0 0 1 1 1v8a1 1 0 0 1-2 0V8a1 1 0 0 1 1-1zm0 10a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                </div>
                <div class="form-group mb-3 position-relative">
                    <input type="email" id="emailInput" class="form-control" placeholder="Email" value="john@example.com">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <div class="form-group mb-3 position-relative">
                    <input type="text" id="addressInput" class="form-control" placeholder="Address" value="123 Main St, Anytown, USA">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a8 8 0 0 1 8 8c0 4.418-7.636 10.8-8 11.154-.364-.354-8-6.736-8-11.154a8 8 0 0 1 8-8zm0 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                    </svg>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button class="btn btn-success px-4 py-2 rounded-pill shadow-sm" id="saveBtn">
                        <i class="bi bi-check-circle me-2"></i> Enregistrer
                    </button>
                    <button class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm" id="cancelBtn">
                        <i class="bi bi-x-circle me-2"></i> Annuler
                    </button>
                </div>
            </div>

            <!-- Boutons -->
            <div class="text-center mt-5" id="buttonSection">
                <button class="btn btn-gradient-primary btn-lg px-5 py-3 rounded-pill text-uppercase shadow-sm" id="editBtn">
                    <i class="bi bi-pencil-square me-2"></i> Modifier
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const editFields = document.getElementById('editFields');
        const infoSection = document.getElementById('infoSection');
        const buttonSection = document.getElementById('buttonSection');

        const nameDisplay = document.getElementById('nameDisplay');
        const ageDisplay = document.getElementById('ageDisplay');
        const mobileDisplay = document.getElementById('mobileDisplay');
        const emailDisplay = document.getElementById('emailDisplay');
        const addressDisplay = document.getElementById('addressDisplay');

        const nameInput = document.getElementById('nameInput');
        const ageInput = document.getElementById('ageInput');
        const mobileInput = document.getElementById('mobileInput');
        const emailInput = document.getElementById('emailInput');
        const addressInput = document.getElementById('addressInput');

        editBtn.addEventListener('click', function () {
            // Basculer vers le mode édition
            editFields.style.display = 'block';
            infoSection.style.display = 'none';
            buttonSection.style.display = 'none';
        });

        saveBtn.addEventListener('click', function () {
            // Valider et mettre à jour les informations
            nameDisplay.innerText = nameInput.value.trim();
            ageDisplay.innerText = ageInput.value.trim();
            mobileDisplay.innerText = mobileInput.value.trim();
            emailDisplay.innerText = emailInput.value.trim();
            addressDisplay.innerText = addressInput.value.trim();

            // Retourner à l'affichage normal
            editFields.style.display = 'none';
            infoSection.style.display = 'block';
            buttonSection.style.display = 'block';
        });

        cancelBtn.addEventListener('click', function () {
            // Annuler les modifications
            nameInput.value = nameDisplay.innerText;
            ageInput.value = ageDisplay.innerText;
            mobileInput.value = mobileDisplay.innerText;
            emailInput.value = emailDisplay.innerText;
            addressInput.value = addressDisplay.innerText;

            // Retourner à l'affichage normal
            editFields.style.display = 'none';
            infoSection.style.display = 'block';
            buttonSection.style.display = 'block';
        });
    });
</script>
@endpush

@push('styles')
<!-- Animation CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">

<style>
    /* Style général */
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 20px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        padding: 2rem;
        border-radius: 20px 20px 0 0;
    }

    .card-body {
        padding: 2rem;
    }

    .profile-picture-container {
        width: 150px;
        height: 150px;
        border: 5px solid #667eea;
        border-radius: 50%;
        padding: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .profile-picture-container:hover {
        transform: scale(1.1);
    }

    .profile-picture {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .text-primary {
        color: #667eea !important;
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #764ba2, #667eea);
        transform: translateY(-2px);
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #218838);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #218838, #28a745);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d, #5a6268);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #5a6268, #6c757d);
        transform: translateY(-2px);
    }

    .form-group {
        position: relative;
    }

    .form-group .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        opacity: 0.7;
        pointer-events: none;
        color: var(--midnight-blue);
    }

    .form-group input {
        padding-left: 48px !important;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
    }
</style>
@endpush
