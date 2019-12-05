<style>
    .alert {
        position: absolute;
        top: 25%;
        left: 25%;
        min-width: 300px;
        width: 50%;
    }
</style>

<?php
function aviso($texto)
{
    echo ("
    <div class='alert alert-success alert alert-dismissible fade show' role='alert'> 
        <div class='container'>
            <h3> Aviso </h3> 
            <p>$texto</p>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </div>");
}

function erro($texto)
{
    echo ("
    <div class='alert alert-danger alert alert-dismissible fade show' role='alert'> 
        <div class='container'>
            <h3> Erro </h3> 
            <p>$texto</p>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </div>");
}

function alerta($texto)
{
    echo ("
    <div class='alert alert-warning alert alert-dismissible fade show' role='alert'> 
        <div class='container'>
            <h3> Alerta </h3> 
            <p>$texto</p>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </div>");
}
